<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));

use App\AppFacade\AppFacade;

$facade = AppFacade::getInstance();
$facade->runApp();
