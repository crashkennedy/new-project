<?php

namespace App\Controllers;

use Config\DBConnection;
use Core\Controller;

class HomePageController extends Controller
{
    public $connection;
    public function __construct(private DBConnection $database)
    {
        $this->connection = $database->getConnection();
    }
    public function renderHomePage()
    {
        return $this->view('home', [
            'products' => $this->getProductInStock(),
            'cart' => $this->userCart()
        ]);
    }
    private function getProductInStock()
    {
        return $this->model('Product')->getProductInStock();
    }

    private function userCart()
    {
        return $this->model('Cart')->getUserCart(2, $this->connection);
    }
}
