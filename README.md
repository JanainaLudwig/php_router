# php_router

A simple PHP router with route parameters.


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
Controllers should be placed in *src/App/Controllers/*. The controller class will be automatically instantiated, and the method specified will be called.

### Variables
To use variables, just declare each one of them in the route, and receive it as a function parameter.

**Closures**

```
$router->get('/item/$id', function($id) {
  //Do another stuff
  echo $id;
});
```

**Controllers**

For a route that expects an user, for example:
```
$router->get('/$user', 'Home@user');
```
The controller method *user* can receive the *$user* variable expecting it as a parameter:
```
class Home {
  public function user($user) {
    echo "Welcome {$user}"; 
  }
}
```
