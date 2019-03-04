<?php
namespace App\Routes;

class RouteComparator {
    public function patternEquals($route, $uri) {
        
        $uri = explode('/', trim($uri, '/'));
        $route = explode('/', trim($route, '/'));;
        
        if (count($uri) != count($route)) {
            return false;
        }

        $result = array_udiff_assoc($route, $uri, function($route, $uri) {
            if (substr($route, 0, 1) === '$') {
                return 0;
            } else if($uri == $route) {
                return 0;
            } else {
                return -1;
            }
        }); 

        return count($result) == 0;
    }

    public function findRoute(array $routes, String $find) {
        $matchedKey = null;

        foreach($routes as $key => $route) {
            if($this->patternEquals($key, $find)) {
                $matchedKey = $key;
                break;
            }
        }

        return $matchedKey;
    }
}