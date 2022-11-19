<?php

namespace App\Core\Models\DiContainer;

use App\Core\Controllers\Error404Controller;
use App\Core\Models\Resource\Environment;
use App\Core\Router\ApiRouter;
use App\Core\Router\ConsoleRouter;
use App\Core\Router\Router;

class DiC
{
    protected $di;
    protected $instanceManager;

    public function __construct(\Laminas\Di\Di $di)
    {
        $this->di = $di;
        $this->instanceManager = $this->di->instanceManager();
    }

    public function assemble()
    {
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method) {
            if (strpos($method->getName(), 'assemble') === 0) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }

    protected function assembleEnvironment()
    {
        $this->instanceManager->addTypePreference(
            \App\Core\Models\CacheInterface::class,
            \App\Core\Models\FileCacheModel::class,
        );
    }

    protected function assembleResource()
    {
        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\AuthorsResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\BooksResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\CategoriesResource::class,
            ['di' => $this->di]
        );
        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\CountriesResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\LibrariesResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\PublishersResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\RegistrationResource::class,
            ['di' => $this->di]
        );


        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\UpdateBooksResource::class,
            ['di' => $this->di]
        );


        $this->instanceManager->setParameters(
            \App\Account\Models\Resource\ClientsBooksResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Account\Models\Resource\UsersResource::class,
            ['di' => $this->di]
        );
    }

    protected function assembleLogger()
    {
        $this->instanceManager->setParameters(
            \App\Core\Models\LoggerModel::class,
            [
                'logger'        => $this->di->get(\Monolog\Logger::class, ['name' => 'SuperBooks']),
                'warningStream' => $this->di->get(
                    \Monolog\Handler\StreamHandler::class,
                    ['stream' => APP_ROOT . '/var/logs/warnings.log']
                ),
                'errorStream' => $this->di->get(
                    \Monolog\Handler\StreamHandler::class,
                    ['stream' => APP_ROOT . '/var/logs/errors.log']
                ),
            ]
        );
    }

    protected function assembleService()
    {
        $spreadSheet = $this->di->get(\PhpOffice\PhpSpreadsheet\Spreadsheet::class);
        $this->instanceManager->setParameters(
            \App\Books\Models\Service::class,
            [
                'spreadsheet' => $spreadSheet,
                'xlsx'        => $this->di->get(
                    \PhpOffice\PhpSpreadsheet\Writer\Xlsx::class,
                    ['spreadsheet' => $spreadSheet]
                ),
            ]
        );
    }

    protected function assembleMailer()
    {
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey(
            'api-key',
            $this->getEnvironment()->getMailerKey()
        );

        $this->instanceManager->setParameters(
            \App\Account\Models\Mailer::class,
            [
                'apiInstance' => $this->di->get(
                    \SendinBlue\Client\Api\TransactionalEmailsApi::class,
                    [
                        'client' => $this->di->get(\GuzzleHttp\Client::class),
                        'config' => $config,
                    ]
                )
            ]
        );
    }

    protected function assembleWebControllers()
    {
        $this->instanceManager->setParameters(
            \App\Account\Controllers\LoginController::class,
            [
                'block'    => $this->di->get(\App\Account\Blocks\SessionBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Account\Controllers\PostLoginController::class,
            [
                'resource' => $this->di->get(\App\Account\Models\Resource\UsersResource::class),
                'service'  => $this->di->get(\App\Account\Models\AccountService::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Account\Controllers\RegistrationController::class,
            [
                'block'    => $this->di->get(\App\Account\Blocks\SessionBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Books\Controllers\CreateAuthorController::class,
            [
                'block'    => $this->di->get(\App\Books\Blocks\AuthorBlock::class),
                'model'    => $this->di->get(\App\Books\Models\AuthorModel::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Books\Controllers\CreateLibraryController::class,
            [
                'model'     => $this->di->get(\App\Books\Models\LibraryModel::class),
                'block'     => $this->di->get(\App\Books\Blocks\LibraryBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            Error404Controller::class,
            [
                'block'    => $this->di->get(\App\Core\Blocks\SimpleBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Core\Controllers\Error403Controller::class,
            [
                'block'    => $this->di->get(\App\Core\Blocks\SimpleBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Core\Controllers\Error500Controller::class,
            [
                'block'    => $this->di->get(\App\Core\Blocks\SimpleBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Core\Controllers\HomePageController::class,
            [
                'block'     => $this->di->get(\App\Core\Blocks\SimpleBlock::class)
            ]
        );

        $this->instanceManager->setParameters(
            \App\Account\Controllers\PostLoginController::class,
            [
                'resource'     => $this->di->get(\App\Account\Models\Resource\UsersResource::class),
                'service'      => $this->di->get(\App\Account\Models\AccountService::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Account\Controllers\SendMailController::class,
            [
                'di' => $this->di,
            ]
        );
    }

    protected function assembleConsoleControllers()
    {
        $this->instanceManager->setParameters(
            \App\Account\Controllers\Console\SendMailController::class,
            [
                'di' => $this->di,
            ]
        );
    }

    protected function assembleCache()
    {
        if ($this->getEnvironment()->getCacheType() == 'redis') {
            $this->changeToRedis();
        }
    }


    protected function assembleRouters()
    {
        $this->instanceManager->setParameters(
            Router::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            ConsoleRouter::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            ApiRouter::class,
            ['di' => $this->di]
        );
    }


    private function getEnvironment()
    {
        return $this->di->get(Environment::class);
    }

    private function changeToRedis()
    {
        $this->instanceManager->unsetTypePreferences(
            \App\Core\Models\CacheInterface::class,
        );

        $this->instanceManager->addTypePreference(
            \App\Core\Models\CacheInterface::class,
            \App\Core\Models\RedisCacheModel::class,
        );
    }
}
