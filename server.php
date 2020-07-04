<?php
//$date = "2020-07-03";
//$date1 = str_replace('-', '/', $date);
//$tomorrow = date('Y-m-d',strtotime($date1 . "+5 days"));
//
//echo $tomorrow;die;
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