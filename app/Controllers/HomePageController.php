<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Core\Controller;

class HomePageController extends Controller
{
    public function renderHomePage()
    {
        global $_settings;
        return $this->view('home', [
            'products' => $this->getProductInStock(),
            'cart' => $this->userCart(),
            'settings' => $_settings
        ]);
    }
    private function getProductInStock()
    {
        return $this->model(Product::class)->getProductInStock($this->connection);
    }

    private function userCart()
    {
        return $this->model(Cart::class)->getUserCart(2, $this->connection);
    }
}
