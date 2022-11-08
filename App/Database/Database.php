<?php

namespace App\Database;

use App\Models\Resource\Environment;

class Database
{
    public function getConnection(): \PDO
    {
        $databaseInfo = new Environment();

        $info = $databaseInfo->getDatabase();

        $host    = $info['HOST'];
        $db      = $info['DB'];
        $charset = $info['CHARSET'];
        $user    = $info['USER'];
        $pass    = $info['PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new \PDO($dsn, $user, $pass, $opt);
    }
}
