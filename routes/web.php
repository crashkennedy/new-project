<?php

use App\Controllers\HomePageController;
use App\Controllers\LoginPageController;
use App\Controllers\RegisterPageController;
use App\Middleware\CheckUserAlreadyExist;
use Config\DBConnection;

$database = new DBConnection();

$router->addRoute('GET', '/register', [new RegisterPageController($database), 'renderRegisterPage'], );
$router->addRoute('POST', '/register', [new RegisterPageController($database), 'registerCustomer'], [new CheckUserAlreadyExist()]);
$router->addRoute('GET', '/login', [new LoginPageController($database), 'renderLoginPage']);
$router->addRoute('POST', '/login', [new LoginPageController($database), 'loginCustomer']);
$router->addRoute('GET', '/', [new HomePageController($database), 'renderHomePage']);