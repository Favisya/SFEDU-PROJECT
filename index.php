<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD'] ?? 'GET');

use App\Router\Router;
use App\Controllers\Error500Controller;
use App\Controllers\Error404Controller;
use App\Exceptions\MvcException;


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
} catch (Exception $e) {
    $controller = new Error500Controller();
    $controller->execute();
}
