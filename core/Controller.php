<?php
namespace Core;

abstract class Controller {
    protected function view($viewName, $data = []) {
        extract($data);
        require_once __DIR__ . "/../app/Views/{$viewName}.php";
    }

    protected function model($modelName) {
        require_once __DIR__ . "/../app/Models/{$modelName}.php";
        return new $modelName();
    }
}