<?php

define('APP_ROOT', __DIR__ . '/..');

require_once APP_ROOT . '/vendor/autoload.php';

use App\App;

$facade = App::getInstance();
$facade->runApp();
