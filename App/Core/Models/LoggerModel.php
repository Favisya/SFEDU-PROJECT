<?php

namespace App\Core\Models;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerModel
{
    private $logger;
    private $warningStream;
    private $errorStream;


    public function __construct(
        Logger $logger,
        StreamHandler $warningStream,
        StreamHandler $errorStream
    ) {
        $this->logger        = $logger;
        $this->warningStream = $warningStream;
        $this->errorStream   = $errorStream;
    }

    public function printWarning(string $msg)
    {
        $this->logger->pushHandler($this->warningStream, Logger::WARNING);
        $this->logger->warning($msg);
    }

    public function printError(string $msg)
    {
        $this->logger->pushHandler($this->errorStream, Logger::ERROR);
        $this->logger->error($msg);
    }
}
