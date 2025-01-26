<?php
namespace Config;

use PDO;
use PDOException;

// if(!defined('DB_SERVER')){
//     require_once("../initialize.php");
// }

class DBConnection {

    private $host;
    private $username;
    private $password;
    private $database;
    private $port;
    private $driver;

    public $conn;

    public function __construct() {
        $this->host = $_ENV['DB_SERVER'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->database = $_ENV['DB_NAME'];
        $this->port = $_ENV['DB_PORT'];
        $this->driver = $_ENV['DB_DRIVER'];

        if (!isset($this->conn)) {
            try {
                $dsn = "{$this->driver}:host={$this->host};port={$this->port};dbname={$this->database};";
                $this->conn = new PDO($dsn, $this->username, $this->password);

                // Set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit;
            }
        }
    }

    public function __destruct() {
        $this->conn = null;
    }

    public function getConnection(): PDO{
        return $this->conn;
    }
}
?>