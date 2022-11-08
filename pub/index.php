<?php

define('APP_ROOT', __DIR__ . '/..');

require_once APP_ROOT . '/vendor/autoload.php';

use App\App;

$di = new \Laminas\Di\Di();

$facade = $di->get(App::class);
$facade->runApp();
