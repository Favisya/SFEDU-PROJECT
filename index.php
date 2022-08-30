<?php

require_once 'vendor/autoload.php';

use App\Router\Router;

$requestPath = $_SERVER['REQUEST_URI'] ?? '';

$routerObject = new Router();
$routerObject->parseControllers($requestPath);