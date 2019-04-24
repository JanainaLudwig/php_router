<?php
namespace App\Routes;

use App\Requests\Request;
use App\App\Controllers\Home;

class Route {
    private $route;
    private $uri;
    private $handle;
    
    function __construct(String $route, String $uri, $handle) {
        $this->route = $route;
        $this->uri = $uri;
        $this->handle = $handle;

        $this->boot();
    }

    private function boot() {
        $routePaths = explode('/', trim($this->route, '/'));
        $uriPaths = explode('/', trim($this->uri, '/'));

        foreach($routePaths as $key => $path) {
            if (substr($path, 0, 1) === '$') {
                $this->{ltrim($path, '$')} = $uriPaths[$key];
            }
        }
    }

    private function getRouteVars() {
        return get_object_vars($this);
    }

    public function execute() {
        extract($this->getRouteVars());

        if (gettype($this->handle) === 'string') {
            $handleArray = explode('@', $this->handle);
            $object = "App\App\Controllers\\{$handleArray[0]}";

            $controller = new $object;

            $method = $handleArray[1];

            $call = [$controller, $method];

            $reflect = new \ReflectionMethod($controller, $method);
        } else {
            $call = $this->handle;
            $reflect = new \ReflectionFunction($call);
        }
        
        $params = array();

        foreach ($reflect->getParameters() as $value) {
            $params[] = ${$value->name};
        }

        call_user_func_array($call, $params);
    }
}