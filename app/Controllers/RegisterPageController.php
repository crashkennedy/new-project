<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserType;
use Assert\Assertion;
use Core\Controller;
use DateTime;

class RegisterPageController extends Controller
{
    public function renderRegisterPage()
    {
        global $_settings;
        return $this->view(
            'register',
            [
                'settings' => $_settings
            ]
        );
    }

    public function registerCustomer()
    {
        $data = $_POST;
        try {
            Assertion::notEmptyKey($data, 'firstName', 'First Name is required');
            Assertion::notEmptyKey($data, 'lastName', 'Last Name is required');
            Assertion::notEmptyKey($data, 'email', 'Email is required');
            Assertion::notEmptyKey($data, 'password', 'Password is required');
            Assertion::notEmptyKey($data, 'userName', 'Username is required');
            Assertion::minLength($data['password'], 8, 'Password must be at least 8 characters long');
            Assertion::notEmptyKey($data, 'confirm_password', 'Confirm Password is required');
            Assertion::Same($data['password'], $data['confirm_password'], 'Passwords do not match');

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['userType'] = UserType::USER->value;
            $dateAdded = new DateTime();
            $dateUpdated = new DateTime();
            $data['date_added'] = $dateAdded->format('Y-m-d H:i:s');
            $data['date_updated'] = $dateUpdated->format('Y-m-d H:i:s');

            $this->model(User::class)->CreateNewUser($data);
            echo json_encode(['message' => 'User created successfully']);
            header('Location: ../login');
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
