<?php
namespace Core;

use Config\DBConnection;

abstract class Controller {
    protected $connection;

    public function __construct() {
        $this->connection = (new DBConnection())->getConnection();
    }

    protected function view($viewName, $data = []) {
        extract($data);
        require_once __DIR__ . "/../app/Views/{$viewName}.php";
    }

    protected function model($modelName) {
        return new $modelName($this->connection);
    }
}