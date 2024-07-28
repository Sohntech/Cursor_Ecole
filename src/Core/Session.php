<?php
namespace Apps\Core;

class Session {
  
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function close() {
        session_unset();
       session_destroy();

    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }


    public static function isset($key) {
        return isset($_SESSION[$key]);
    }
}
