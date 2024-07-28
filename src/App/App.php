<?php

namespace Apps\App;
use Apps\Core\Database\MysqlDatabase;
require_once "../config/config.php";


class App
{
    private static $instance;
    private static $database;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getDatabase() {
        if (self::$database === null) {
            $dsn="mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
            self::$database = new MysqlDatabase($dsn,DB_USER,DB_PASSWORD);
        }
        return self::$database;
    }

    public function getModel($model)
    {
        $db = self::getDatabase();
        
      $modelClass = "Apps\\App\\Model\\" .ucfirst($model);
        return new $modelClass($db);
    }

    public function notFound() {
        require_once dirname(__DIR__,2) . "/views/404.html.php";
    }

    public function forbidden() {
        require_once dirname(__DIR__) . "/views/403.html.php";
    }

}


