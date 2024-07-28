<?php
namespace Apps\Core\Security;
use Apps\Core\Session;


class AuthMiddleware {
    public static function check() {
        if (!Session::isset('user')) {
            header('Location: /login');
            exit();
        }
    }
}