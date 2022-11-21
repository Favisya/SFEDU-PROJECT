<?php

namespace App\Account\Models\DiContainer;

use App\Core\Controllers\Error404Controller;
use App\Core\Models\DiContainer\AbstractDiC;
use App\Core\Models\Resource\Environment;
use App\Core\Router\ApiRouter;
use App\Core\Router\ConsoleRouter;
use App\Core\Router\Router;

class DiC extends AbstractDiC
{
    protected function assembleAccountResources()
    {
        $this->instanceManager->setParameters(
            \App\Account\Models\Resource\ClientsBooksResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Account\Models\Resource\UsersResource::class,
            ['di' => $this->di]
        );
    }

    protected function assembleWebAccountControllers()
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
}
