<?php

namespace App\Database;

class Database
{
    private static $instance;

    private $host = '127.0.0.1';
    private $db   = 'books_3V';
    private $user = 'dima';
    private $pass = 'fuckme420';
    private $charset = 'utf8';

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new \PDO($dsn, $this->user, $this->pass, $opt);
    }
}
