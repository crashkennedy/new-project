<?php

use Config\DBConnection;
use Config\SystemSettings;
use Core\Router;

require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . '/initialize.php';

$dbConnection = new DBConnection();
$_settings = new SystemSettings($dbConnection);
$_settings->load_system_info_from_db();

var_dump($_ENV);
$router = new Router();
require_once __DIR__ . '/routes/web.php';

// load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();





$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $path);