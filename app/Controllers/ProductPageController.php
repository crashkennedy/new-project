<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Controller;

class ProductPageController extends Controller
{
    public function renderProductPage()
    {
        global $_settings;
        return $this->view('product', [
            'products' => $this->getProductInStock(),
        ]);
    }
    private function getProductInStock()
    {
        return $this->model(Product::class)->getProductInStock($this->connection);
    }
}
