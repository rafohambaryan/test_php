<?php

namespace app\database;

class Migration
{
    protected $table;
    protected $run;

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
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table}({$this->run}) ENGINE InnoDB";
        var_dump($sql);
    }

    protected function downMigrate()
    {
        $sql = "DROP TABLE IF NOT EXISTS {$this->table}";
        var_dump($sql);
    }
}