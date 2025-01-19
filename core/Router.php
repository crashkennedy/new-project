<?php
namespace Core;

class Router {
    protected $routes = [];

    public function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($method, $path) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                // Call the appropriate controller method
                call_user_func($route['handler']);
                return;
            }
        }
        // Handle 404
        http_response_code(404);
        echo "Page not found";
    }
}