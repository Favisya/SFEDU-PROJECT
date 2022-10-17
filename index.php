<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));

use App\App;

$facade = App::getInstance();
$facade->runApp();
