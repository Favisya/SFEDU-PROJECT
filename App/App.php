<?php

namespace App;

use App\Controllers\Error404Controller;
use App\Controllers\Error500Controller;
use App\Exceptions\MvcException;
use App\Models\DiC;
use App\Models\LoggerModel;
use App\Models\RouterFactory;
use Laminas\Di\Di;

class App
{
    protected $di;

    public function __construct(Di $di)
    {
        $this->di = $di;
    }

    public function runApp(): void
    {
        $requestPath = $_SERVER['REQUEST_URI'] ?? '';
        $diC = new DiC($this->di);
        $diC->assemble();

        $controller = $this->getController($requestPath);
        $logger = $this->di->get(LoggerModel::class);

        try {
            if ($controller !== false) {
                $controller->execute();
            }
        } catch (MvcException $e) {
            $logger->printWarning($e->getMessage());
            $controller = $this->di->get(Error404Controller::class);
            $controller->execute();
        } catch (\Exception $e) {
            $logger->printError($e->getMessage());
            $controller = $this->di->get(Error500Controller::class);
            $controller->execute();
        }
    }


    private function getController(string $requestPath)
    {
        $routerFactory = $this->di->get(RouterFactory::class);
        $router = $routerFactory->routerFactory($requestPath);
        return $router->parseControllers($requestPath);
    }
}
