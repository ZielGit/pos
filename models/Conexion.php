<?php

namespace Models;

use PDO;

class Conexion
{
    public static function conectar()
    {
        $db_host = $_ENV['DB_HOST'];
        $db_database = $_ENV['DB_DATABASE'];
        $db_username = $_ENV['DB_USERNAME'];
        $db_password = $_ENV['DB_PASSWORD'];

        $link = new PDO("mysql:host={$db_host};dbname={$db_database}", $db_username, $db_password);
        $link->exec("set names utf8");
        return $link;
    }
}
