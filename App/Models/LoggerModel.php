<?php

namespace App\Models;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerModel
{
    private static $instance;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new LoggerModel();
        }

        return self::$instance;
    }

    public function printWarning(string $msg)
    {
        $log = new Logger('warning');
        $log->pushHandler(new StreamHandler(APP_ROOT . '/var/logs/warnings.log'), Logger::WARNING);
        $log->warning($msg);
    }

    public function printError(string $msg)
    {
        $log = new Logger('error');
        $log->pushHandler(new StreamHandler(APP_ROOT . '/var/logs/errors.log'), Logger::ERROR);
        $log->error($msg);
    }
}
