<?php

spl_autoload_register(function ($class_name) {
    $url = str_replace('\\', '/', ROOT . $class_name . '.php');
    if (file_exists($url)) {
        require_once $url;
    } else {
        echo "$url Class does not exist";
        die;
    }
});

use app\core\Route;

new Route();