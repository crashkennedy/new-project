<?php

namespace App\Controllers;

use App\Models\User;
use Assert\Assertion;
use Config\DBConnection;
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
        $data = $_POST;
        try {
            Assertion::notEmptyKey($data, 'userName', 'username is required');
            Assertion::notEmptyKey($data, 'password', 'Password is required');
            /** @var User */
            $user = $this->model(User::class)->getUserByUsername($data['userName'], $this->connection);
            if ($user && password_verify($data['password'], $user['password'])) {
                echo json_encode(['message' => 'User logged in successfully']);
                header('Location: /');
            } else {
                echo json_encode(['message' => 'Invalid username or password']);
                // header('Location: ../login');
            }

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

}