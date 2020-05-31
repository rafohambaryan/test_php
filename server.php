<?php
spl_autoload_register(function ($class_name) {
    if (file_exists(ROOT . "$class_name.php")) {
        require_once ROOT . "{$class_name}.php";
    } else {
        echo "$class_name.php Class does not exist";
        die;
    }
});
use app\core\Route;
new Route();