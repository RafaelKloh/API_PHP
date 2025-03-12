<?php

namespace App\models;
use PDO;

Class Database
{
    public static function get_connection()
    {
        $pdo = new PDO("mysql:dbname=api_php;host=localhost", "root", "");
        return $pdo;
    }
}