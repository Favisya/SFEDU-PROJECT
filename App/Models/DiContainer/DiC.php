<?php

namespace App\Models\DiContainer;

use App\Controllers\Error404Controller;
use App\Models\Resource\Environment;
use App\Router\ApiRouter;
use App\Router\ConsoleRouter;
use App\Router\Router;

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
            \App\Models\CacheInterface::class,
            \App\Models\FileCacheModel::class,
        );
    }

    protected function assembleResource()
    {
        $resources = scandir(APP_ROOT . '/App/Models/Resource');
        $resources = array_slice($resources, 2);

        $namespace = 'App\Models\Resource\\';

        foreach ($resources as $resource) {
            $resource = str_replace('.php', '', $resource);
            $resource = $namespace . $resource;
            $this->instanceManager->setParameters(
                $resource,
                ['di' => $this->di]
            );
        }
    }

    protected function assembleLogger()
    {
        $this->instanceManager->setParameters(
            \App\Models\LoggerModel::class,
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
            \App\Models\Service::class,
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
            \App\Models\Mailer::class,
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
            \App\Controllers\LoginController::class,
            [
                'block'    => $this->di->get(\App\Blocks\SessionBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\PostLoginController::class,
            [
                'resource' => $this->di->get(\App\Models\Resource\LoginResource::class),
                'service'  => $this->di->get(\App\Models\AccountService::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\RegistrationController::class,
            [
                'block'    => $this->di->get(\App\Blocks\SessionBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\CreateAuthorController::class,
            [
                'block'    => $this->di->get(\App\Blocks\AuthorBlock::class),
                'model'    => $this->di->get(\App\Models\AuthorModel::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\CreateLibraryController::class,
            [
                'model'     => $this->di->get(\App\Models\LibraryModel::class),
                'block'     => $this->di->get(\App\Blocks\LibraryBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            Error404Controller::class,
            [
                'block'    => $this->di->get(\App\Blocks\SimpleBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\Error403Controller::class,
            [
                'block'    => $this->di->get(\App\Blocks\SimpleBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\Error500Controller::class,
            [
                'block'    => $this->di->get(\App\Blocks\SimpleBlock::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\HomePageController::class,
            [
                'block'     => $this->di->get(\App\Blocks\SimpleBlock::class)
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\PostLoginController::class,
            [
                'resource'     => $this->di->get(\App\Models\Resource\LoginResource::class),
                'service'      => $this->di->get(\App\Models\AccountService::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Controllers\SendMailController::class,
            [
                'di' => $this->di,
            ]
        );
    }

    protected function assembleConsoleControllers()
    {
        $this->instanceManager->setParameters(
            \App\Controllers\Console\SendMailController::class,
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
            \App\Models\CacheInterface::class,
        );

        $this->instanceManager->addTypePreference(
            \App\Models\CacheInterface::class,
            \App\Models\RedisCacheModel::class,
        );
    }
}
