<?php

require_once 'vendor/autoload.php';

use App\Router\Router;

$requestPath = $_SERVER['REQUEST_URI'] ?? '';

$routerObject = new Router();
$controller = $routerObject->parseControllers($requestPath);

if ($controller !== false) {
    $controller->showControllerName();
}