#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));
define('CSV_FORMAT', 'csv');

$router = new \App\Router\ConsoleRouter();

if (isset($argv[1])) {
    $controller = $router->parseControllers($argv[1]);

    if (!isset($argv[2])) {
        $controller->setArguments([CSV_FORMAT]);
    }

    $arguments = [$argv[2], $argv[3], $argv[4]];
    $arguments = array_diff($arguments, [0, null]);

    $controller->setArguments($arguments);

    $controller->execute();
} else {
    echo 'Missing argument!' . PHP_EOL;
}
