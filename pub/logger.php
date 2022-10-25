<?php

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

function printWarning(string $msg)
{
    $log = new Logger('warning');
    $log->pushHandler(new StreamHandler(APP_ROOT . '/var/logs/warnings.log'), Logger::WARNING);
    $log->warning($msg);
}

function printError(string $msg)
{
    $log = new Logger('error');
    $log->pushHandler(new StreamHandler(APP_ROOT . '/var/logs/errors.log'), Logger::ERROR);
    $log->error($msg);
}
