<?php

namespace App\Controllers;

use Core\Controller;

class HomePageController extends Controller
{
    public function renderHomePage()
    {
        return $this->view('home');
    }
}