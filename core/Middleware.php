<?php

namespace Core;

abstract class Middleware {
    /**
     * Handle the middleware logic
     *
     * @param mixed $request The incoming request
     * @param callable $next The next middleware or final request handler
     * @return mixed
     */
    abstract public function handle($request, callable $next);


}