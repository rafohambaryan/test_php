<?php

namespace app\database;

use app\core\Model;

class Migration
{
    protected $table;
    protected $run;
    public $sql = '';

    public function __construct($command)
    {
        switch ($command) {
            case 'run':
                $this->runMigrate();
                break;
            case 'down':
                $this->downMigrate();
                break;
        }
    }

    protected function runMigrate()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table}({$this->run}) ENGINE InnoDB;";
        $this->sql .= $sql;
    }

    protected function downMigrate()
    {
        $sql = "DROP TABLE IF EXISTS {$this->table};";
        $this->sql .= $sql;
    }
}