<?php

namespace App\Models;

use PDO;

class Cart {
    // private int $customer_id;
    // private int $product_id;
    // private int $quantity;

    public function __construct(
        // int $customer_id,
        // int $product_id,
        // int $quantity,
        private PDO $conn
    ) {
    }

    public static function getUserCart(int $customer_id, PDO $conn) {
        $query = "SELECT SUM(quantity) FROM cart_list WHERE customer_id = :customer_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();

    }
}