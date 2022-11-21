#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));
define('CSV_FORMAT', 'csv');

$di = new \Laminas\Di\Di();

$moduleAggregator = $di->get(\App\ModuleSettingsAggregator::class);
$diContainers = $moduleAggregator->getDiContainers();

foreach ($diContainers as $container) {
    $dic = new $container($di);
    $dic->assemble();
}

$router = $di->get(\App\Core\Router\ConsoleRouter::class, [$di]);

if (isset($argv[1])) {
    $controller = $router->parseControllers($argv[1]);

    if (!isset($argv[2])) {
        $controller->setArguments([CSV_FORMAT]);
    }

    $arguments = [$argv[2], $argv[3] ?? null, $argv[4] ?? null];
    $arguments = array_diff($arguments, [0, null]);

    $controller->setArguments($arguments);

    $controller->execute();
} else {
    echo 'Missing argument!' . PHP_EOL;
}
