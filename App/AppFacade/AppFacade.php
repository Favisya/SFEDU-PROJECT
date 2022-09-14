<?php

namespace App\AppFacade;

use App\Controllers\Error404Controller;
use App\Controllers\Error500Controller;
use App\Exceptions\MvcException;
use App\Router\Router;

class AppFacade
{
    private static $instance;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new AppFacade();
        }

        return self::$instance;
    }

    public function runApp(): void
    {
        $requestPath = $_SERVER['REQUEST_URI'] ?? '';

        $routerObject = new Router();
        $controller = $routerObject->parseControllers($requestPath);

        try {
            if ($controller !== false) {
                $controller->execute();
            }
        } catch (MvcException $e) {
            $controller = new Error404Controller();
            $controller->execute();
        } catch (\Exception $e) {
            $controller = new Error500Controller();
            $controller->execute();
        }
    }
}
