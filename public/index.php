<?php
try {
    session_start();
    error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors', 1);
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/define/define.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/server.php';
} catch (Exception $exception) {
    echo $exception->getMessage();
}