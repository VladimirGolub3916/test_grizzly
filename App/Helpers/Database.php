<?php

namespace App\Helpers;

use PDO;

class Database
{
    public static function getConnection(): PDO
    {
        $config = include __DIR__ . '/../Config/config.php';
        return new PDO($config['dsn'], $config['username'], $config['password']);
    }
}
