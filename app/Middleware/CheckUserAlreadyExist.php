<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Models\User;
use Config\DBConnection;
use Core\Middleware;
use PDO;

class CheckUserAlreadyExist extends Middleware {

    private $conn;

    public function __construct() {
        $this->conn = (new DBConnection())->getConnection();
    }

    public function handle($request, callable $next): mixed {
        $user = $this->isUserAlreadyExist($_POST['userName'], $this->conn);
        if ($user) {
          http_response_code(400);
           echo json_encode(['message' => 'User already exist']);
           exit;
        }

        return $next($request);
    }


    private function isUserAlreadyExist( string $username, PDO $conn) {
        $user = new User($conn);
        return $user->GetUserByUsername($username, $conn);
    }
}