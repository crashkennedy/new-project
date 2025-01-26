<?php

namespace App\Models;

use PDO;

class Cart {
    private int $customer_id;
    private int $product_id;
    private int $quantity;

    public function __construct(
        int $customer_id,
        int $product_id,
        int $quantity,
        private PDO $conn
    ) {
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public static function getUserCart(int $customer_id, PDO $conn) {
        $query = "SELECT SUM(quantity) FROM `cart_list` where customer_id = '{$customer_id}' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch()[0];

    }
}