<?php

use app\database\Migration;

class migration_users_table extends Migration
{
    protected $table = 'users';

    protected $run = 'id INT(11),
                      name VARCHAR(255)';
}