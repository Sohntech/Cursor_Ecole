<?php 
define('ROOT', '/var/www/html/school');
require ROOT . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();
define('DB_PORT', $_ENV['DB_PORT']);
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define("WEBROOT", $_ENV["WEBROOT"]);
define("VIEWS", ROOT."/views/");
require_once ROOT."/routes/web.php";


























// define('DB_TYPE', $_ENV['DB_TYPE']);