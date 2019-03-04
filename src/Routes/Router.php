<?php
namespace App\Routes;

use App\Requests\Request;
use App\Routes\Route;
use App\Routes\RouteFormatter;
use App\Routes\RouteComparator;

class Router {
    private $request;
    private $comparator;
    private $formatter;

    private $supportedHttpMethods = [
        'GET',
        'POST'
    ];

    function __construct(Request $request) {
        $this->request = $request;
        $this->comparator = new RouteComparator;
        $this->formatter = new RouteFormatter;
    }

    function __call($httpMethod, $arguments) {
        list($route, $callback) = $arguments;

        if(!in_array(strtoupper($httpMethod), $this->supportedHttpMethods)) {
          $this->invalidMethodHandler();
        }

        $route = $this->formatter->format($route);

        $this->{$httpMethod}[$route] = $callback;
    }

    private function resolve() {
        $requestedUri = $this->request->request_uri;
        $registeredRoutes = $this->{strtolower($this->request->request_method)};

        $matchedRoute = $this->comparator->findRoute($registeredRoutes, $requestedUri);

        if ($matchedRoute == null) {
            $this->defaultMethodHandler();
        }

        $route = new Route($matchedRoute, $requestedUri, $registeredRoutes[$matchedRoute]);
        
        $route->execute();
    }

    private function invalidMethodHandler() {
        echo 'Method Not Allowed';
        header("HTTP/1.0 405 Method Not Allowed");
        exit();
    }

    private function defaultMethodHandler() {
        echo 'Not found';
        header("HTTP/1.0 404 Not Found");
        exit();
    }

    function __destruct() {
        $this->resolve();
    }
}