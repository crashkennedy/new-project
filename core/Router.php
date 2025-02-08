<?php
namespace Core;

class Router {
    protected $routes = [];

    public function addRoute($method, $path, $handler, $middleware = []) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    // public function dispatch($method, $path) {
    //     foreach ($this->routes as $route) {
    //         if ($route['method'] === $method && $route['path'] === $path) {
    //             // Call the appropriate controller method
    //             call_user_func($route['handler']);
    //             return;
    //         }
    //     }

    public function dispatch($method, $path) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                // Process middleware
                $request = $_REQUEST;

                $next = function($request) use ($route) {
                    // Final handler
                    return call_user_func($route['handler'], $request);
                };

                // Run middleware in order
                foreach (array_reverse($route['middleware']) as $middlewareClass) {
                    $middleware = new $middlewareClass();
                    $next = function($request) use ($middleware, $next) {
                        return $middleware->handle($request, $next);
                    };
                }

                // Execute first middleware (which will chain through others)
                $next($request);
                return;
            }
        }
        // Handle 404
        http_response_code(404);
        echo "Page not found";
    }
}