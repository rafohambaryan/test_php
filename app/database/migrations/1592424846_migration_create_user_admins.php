<?php

use app\database\Migration;

class migration_create_user_admins extends Migration 
{ 
    protected $table = 'user_admins';
 
    protected $run = '`id`         INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      `name`       VARCHAR(255) NULL,
                      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
}