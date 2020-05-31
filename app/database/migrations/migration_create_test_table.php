<?php

use app\database\Migration;

class migration_create_test_table extends Migration
{
    protected $table = 'tests';

    protected $run = 'id INT(11),
                      name VARCHAR(255),
                      last_name VARCHAR(255)';
}