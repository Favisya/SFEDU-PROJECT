<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD'] ?? 'GET');

use App\Router\Router;

$requestPath = $_SERVER['REQUEST_URI'] ?? '';

$routerObject = new Router();
$controller = $routerObject->parseControllers($requestPath);

if ($controller !== false) {
    $controller->execute();
}
