<?php

define('APP_ROOT', __DIR__ . '/..');

require_once APP_ROOT . '/vendor/autoload.php';
require_once APP_ROOT . '/pub/logger.php';

use App\App;

$facade = App::getInstance();
$facade->runApp();
