<?php

use Config\DBConnection;
use Config\SystemSettings;
use Core\Router;

require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . '/initialize.php';



// load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbConnection = new DBConnection();
$_settings = new SystemSettings($dbConnection);
$_settings->load_system_info_from_db();
global $_settings;

$router = new Router();
require_once __DIR__ . '/routes/web.php';




$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $path);