<?php

use App\Controllers\HomePageController;
use Config\DBConnection;

$database = new DBConnection();

// $router->addRoute('GET', '/register', [new UserController(), 'register']);
$router->addRoute('GET', '/', [new HomePageController($database), 'renderHomePage']);