<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";

use App\Requests\Request;
use App\Routes\Router;

$request = new Request();
$router = new Router($request);

$router->get('/', function() {
    echo '/';
});

$router->get('/item/$item', function($item) {
    echo "Item $item";
});

$router->get('/item/$item/edit', function($item) {
    echo "Edit item $item";
});
