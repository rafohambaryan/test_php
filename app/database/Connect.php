<?php

namespace app\database;

use PDO;
use PDOException;

class Connect
{
    public $conn;
    private $db_host;
    private $db_user;
    private $db_base;
    private $db_password;

    public function __construct()
    {
        $connect = require_once __DIR__. '/config.php';
        $this->db_host = $connect['db_host'];
        $this->db_user = $connect['db_user'];
        $this->db_base = $connect['db_base'];
        $this->db_password = $connect['db_password'];
        $this->connect();
    }

    private function connect()
    {
        try {
            $conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_base", $this->db_user, $this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}