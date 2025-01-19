<?php

use Core\Router;

require_once __DIR__ . '/vendor/autoload.php';


$router = new Router();
require_once __DIR__ . '/routes/web.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $path);