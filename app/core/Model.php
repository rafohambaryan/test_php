<?php


namespace app\core;


use app\database\Connect;
use PDO;

class Model
{
    use Connect;

    protected $table;

    public function createDb($sql)
    {
        if (empty($sql))
            return false;
        // Connect to the database
        $db = self::conn();
        $stmt = $db->prepare($sql);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function all()
    {
        return $this->select("SELECT * FROM {$this->table}");
    }

    public function find($id)
    {
        return current($this->select("SELECT * FROM {$this->table} WHERE `id` = {$id}"));
    }

    public function created($data)
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
        $db = self::conn();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetchObject()) {
                $row->{'app'} = $this;
                $results[] = $row;
            }
        }
        return $results;
    }

    public function save($user)
    {
        return $user;
    }

    private function insert($table, $data, $func = 'INSERT INTO')
    {
        $key = '';
        $value = '';
        foreach ($data as $index => $datum) {
            $key .= $index . ',';
            $value .= ':' . $index . ',';
        }
        $key = substr($key, 0, -1);
        $value = substr($value, 0, -1);
        $conn = self::conn();
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