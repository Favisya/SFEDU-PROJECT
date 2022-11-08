<?php

namespace App\Models;

use Laminas\Di\Di;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerModel
{
    private $di;
    private $log;

    public function __construct(Di $di)
    {
        $this->di  = $di;
        $this->log = $di->get(Logger::class, ['name' => 'problem']);
    }

    public function printWarning(string $msg)
    {
        $log = $this->log;
        $log->pushHandler(
            $this->di->get(
                StreamHandler::class,
                ['stream' => APP_ROOT . '/var/logs/warnings.log']
            ),
            Logger::WARNING
        );
        $log->warning($msg);
    }

    public function printError(string $msg)
    {
        $log = $this->log;
        $log->pushHandler(
            $this->di->get(
                StreamHandler::class,
                ['stream' => APP_ROOT . '/var/logs/errors.log']
            ),
            Logger::ERROR
        );
        $log->error($msg);
    }
}
