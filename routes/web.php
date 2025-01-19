<?php

use App\Controllers\HomePageController;

// $router->addRoute('GET', '/register', [new UserController(), 'register']);
// $router->addRoute('POST', '/register', [new UserController(), 'register']);
$router->addRoute('GET', '/', [new HomePageController(), 'renderHomePage']);