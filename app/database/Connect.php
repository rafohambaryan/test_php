<?php

namespace app\database;

use PDO;
use PDOException;

trait Connect
{
    private static $conn;

    private function conn()
    {
        self::$conn ?: $this->connect();
        return self::$conn;
    }

    private function connect()
    {
        $connect = require_once __DIR__ . '/config.php';
        $db_host = $connect['db_host'];
        $db_user = $connect['db_user'];
        $db_base = $connect['db_base'];
        $db_password = $connect['db_password'];

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn = $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}