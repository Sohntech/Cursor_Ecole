<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once "../config/config.php";




// var_dump(ROOT);









































































// // ini_set('display_errors', 1);
// // ini_set('display_startup_errors', 1);
// // error_reporting(E_ALL);
// define('ROOT', dirname(__DIR__));
// var_dump(ROOT);
// require ROOT . '/vendor/autoload.php';
// use Apps\Core\Router;




// $routes = [
//     "home" => ["controller" => "ClientController", "action" => "showHome"],
//     "add-client" => ["controller" => "ClientController", "action" => "addClient"],
//     "check-client" => ["controller" => "ClientController", "action" => "searchClientByTel"]
// ];

// $uri = trim($_SERVER['REQUEST_URI'], '/');
// $uri =  preg_replace('#/+#', '/', $uri);
// $routeur = new Router($routes);
// $routeur->create($uri);




// "dette/view/(\d+)" => ["controller" => "ExoController", "action" => "view"],






























// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// define('ROOT', dirname(__DIR__));
// require ROOT . '/vendor/autoload.php';
// use Apps\Core\Router;

// $routes = [
//     "home" => ["controller" => "ClientController", "action" => "showHome"],
//     "dette/view/(\d+)" => ["controller" => "ExoController", "action" => "view"],
//     "add-client" => ["controller" => "ClientController", "action" => "addClient"],
// ];


// $uri = trim($_SERVER['REQUEST_URI'], '/');
// $uri =  preg_replace('#/+#', '/', $uri);
// $routeur = new Router($routes);
// $routeur->create($uri);



























// $uri = trim($_SERVER['REQUEST_URI'], '/');
// $routeur = new Router($uri, $routes);
// $routeur->create($uri);