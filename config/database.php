<?php

require(__DIR__ . "/../vendor/autoload.php");

use Medoo\Medoo;

class Database
{
    function mysql()
    {
        $database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'monitoring_server',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
        ]);
        return $database;
    }
}
