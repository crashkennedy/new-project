<?php

use Core\Router;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();
require_once __DIR__ . '/routes/web.php';

// load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $path);