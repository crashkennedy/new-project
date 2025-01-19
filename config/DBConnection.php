<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBConnection {

    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    private $port = DB_PORT;
    private $driver = DB_DRIVER;
    
    public $conn;
    
    public function __construct() {
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
}
?>