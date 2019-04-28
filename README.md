# php_router

A simple PHP router with variables.


## Syntax
**Closures**

$router->**httpMethod**(**'route'**, **closure**);
```
$router->get('/', function() {
  //Do some stuff
});
```
**Controllers**

$router->**httpMethod**(**route**, **'ControllerName@method'**);
```
$router->get('/', 'HomeController@index');
```
Controllers should be placed in *src/App/Controllers/*

### Variables
To use variables, just declare each one of them in the route, and receive it as a function parameter.
```
$router->get('/item/$id', function($id) {
  //Do another stuff
  echo $id;
});
```
