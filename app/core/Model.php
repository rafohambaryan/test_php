<?php


namespace app\core;


use app\database\Connect;
use PDO;

class Model extends Connect
{
    protected $table;

    public function all()
    {
        return $this->select("SELECT * FROM {$this->table}");
    }

    public function find($id)
    {
        return current($this->select("SELECT * FROM {$this->table} WHERE `id` = {$id}"));
    }

    public function create($data)
    {
        return $this->insert($this->table, $data);
    }

    public function where($query, $get = 'get')
    {
        $data = $this->select("SELECT * FROM {$this->table} WHERE {$query}");
        switch ($get) {
            case 'first':
                return current($data);
                break;
            case 'last':
                return end($data);
                break;
            default:
                return $data;
        }
    }

    private function select($query)
    {
        $db = $this->conn;
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetchObject()) {
                $results[] = $row;
            }
        }
        return $results;
    }

    private function insert($table, $data)
    {
        $key = '';
        $value = '';
        foreach ($data as $index => $datum) {
            $key .= $index . ',';
            $value .= ':' . $index . ',';
        }
        $key = substr($key, 0, -1);
        $value = substr($value, 0, -1);
        $conn = $this->conn;
        $sql_insert = $conn->prepare("INSERT INTO {$table} ({$key}) VALUES ({$value});");
        foreach ($data as $item => $val) {
            $sql_insert->bindValue(':' . $item, $val);
        }
        try {
            $sql_insert->execute();
            $last_id = $conn->lastInsertId();
            $conn = null;
            return ['success' => true, 'id' => $last_id];
        } catch (\Exception $exception) {
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}