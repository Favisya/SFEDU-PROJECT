<?php

namespace App;

use App\Core\Controllers\Error404Controller;
use App\Core\Controllers\Error500Controller;
use App\Core\Exceptions\MvcException;
use App\Core\Models\DiContainer\DiC;
use App\Core\Models\LoggerModel;
use App\Core\Models\RouterFactory;
use Laminas\Di\Di;

class  App
{
    protected $di;
    protected $logger;

    public function __construct(Di $di)
    {
        $this->di = $di;

    }

    public function runApp(): void
    {
        $requestPath = $_SERVER['REQUEST_URI'] ?? '';
        $diC = new DiC($this->di);
        $diC->assemble();

        $this->logger = $this->di->get(LoggerModel::class);

        $controller = $this->getController($requestPath);

        try {
            if ($controller !== false) {
                $controller->execute();
            }
        } catch (MvcException $e) {
            $this->logger->printWarning($e->getMessage());
            $controller = $this->di->get(Error404Controller::class);
            $controller->execute();
        } catch (\Exception $e) {
            $this->logger->printError($e->getMessage());
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
