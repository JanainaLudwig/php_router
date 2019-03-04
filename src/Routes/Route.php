<?php
namespace App\Routes;

use App\Requests\Request;

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

        $reflect = new \ReflectionFunction($this->handle);
        
        $params = array();

        foreach ($reflect->getParameters() as $value) {
            $params[] = ${$value->name};
        }

        call_user_func_array($this->handle, $params);
    }
}