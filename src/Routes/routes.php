<?php
use App\Requests\Request;
use App\Routes\Router;

$request = new Request();
$router = new Router($request);

$router->get('/', 'Home@home');

$router->get('/$user', 'Home@user');

$router->get('/item/$item', function($item) {
    echo "Item $item";
});

$router->get('/item/$item/edit', function($item) {
    echo "Edit item $item";
});
