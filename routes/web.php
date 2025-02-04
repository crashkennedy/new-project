<?php

use App\Controllers\HomePageController;
use App\Controllers\LoginPageController;
use Config\DBConnection;

$database = new DBConnection();

// $router->addRoute('GET', '/register', [new UserController(), 'register']);
$router->addRoute('GET', '/login', [new LoginPageController($database), 'renderLoginPage']);
$router->addRoute('POST', '/login', [new LoginPageController($database), 'loginCustomer']);
$router->addRoute('GET', '/', [new HomePageController($database), 'renderHomePage']);