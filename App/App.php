<?php

namespace App;

use App\Controllers\Error404Controller;
use App\Controllers\Error403Controller;
use App\Controllers\Error500Controller;
use App\Exceptions\CsrfException;
use App\Exceptions\MvcException;
use App\Router\Router;

class App
{
    private static $instance;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new App();
        }

        return self::$instance;
    }

    public function runApp(): void
    {
        $requestPath = $_SERVER['REQUEST_URI'] ?? '';
        $controller = $this->getController($requestPath);

        try {
            if ($controller !== false) {
                $controller->execute();
            }
        } catch (MvcException $e) {
            $controller = new Error404Controller();
            $controller->execute();
            printWarning($e->getMessage());
        } catch (\Exception $e) {
            $controller = new Error500Controller();
            $controller->execute();
            printError($e->getMessage());
        } catch (CsrfException $e) {
            $controller = new Error403Controller();
            $controller->execute();
            printError($e->getMessage());
        }
    }


    private function getController(string $requestPath)
    {
        $routerObject = new Router();
        $router = $routerObject->routerFactory($requestPath);
        return $router->parseControllers($requestPath);
    }
}
