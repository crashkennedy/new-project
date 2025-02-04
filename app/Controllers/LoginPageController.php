<?php

namespace App\Controllers;

use Core\Controller;

class LoginPageController extends Controller
{
    public function renderLoginPage()
    {
        global $_settings;
        return $this->view('login',
            [
                'settings' => $_settings
            ]
        );
    }

    public function loginCustomer()
    {
        // global $_settings;
    }

}