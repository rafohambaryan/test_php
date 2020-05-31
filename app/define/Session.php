<?php


namespace app\define;


class Session
{
    private static $user_id = null;

    public static function remove():void
    {
        if (isset($_SESSION['user_id'])) {
            self::$user_id = $_SESSION['user_id'];
        }
        session_unset();
        if (self::$user_id) {
            $_SESSION['user_id'] = self::$user_id;
        }
    }

    public static function removeAll():void
    {
        session_unset();
    }

    public static function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key];
    }
}