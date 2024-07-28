<?php
namespace Apps\Core;

use Apps\Core\Session;

class Controller {
    // protected Session $session;

    public function __construct() {
        Session::start();
        if (!Session::get('user') && $_SERVER['REQUEST_URI'] != 'login') {
            $this->redirect("login");
            exit;
        }
    }

    public function renderView($view, $data = []) {
        extract($data);
        switch ($view) {
            case "layout":
                include dirname(__DIR__, 2) . "/views/layout.html.php";
                break;
            default:
                include dirname(__DIR__, 2) . "/views/layout.html.php";
                include dirname(__DIR__, 2) . "/views/$view.html.php";
                break;
        }
        
    }

    public function redirect($url) {
        header("Location: $url");
        exit;
    }

     public function toJson(){}

     public function fromJson(){}
}

