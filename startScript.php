#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));
define('CSV_FORMAT', 'csv');
$router = new \App\Router\ConsoleRouter();

if (isset($argv[1])) {
    $controller = $router->parseControllers($argv[1]);

    if (!isset($argv[2])) {
        $controller->setArgument([CSV_FORMAT]);
    }

    $controller->setArgument([$argv[2], $argv[3]]);

    $controller->execute();
} else {
    echo 'Missing argument!' . PHP_EOL;
}
