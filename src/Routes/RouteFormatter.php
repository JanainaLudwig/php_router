<?php
namespace App\Routes;

class RouteFormatter {
    
    public function format($route) {
        if ($route == '/') {
            return $route;
        }

        $route = rtrim($route, '/');

        return $route;
    }
}