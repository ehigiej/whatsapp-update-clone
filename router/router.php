<?php
/* HANDLE ROUTES OF APP 
CREATE A CLASS ROUTER that takes an array of routes and thier respective methods 
create a function url that takes two paraments (REQUESTED URL, REQUEST METHOD);
check class routes array for method and url and return the respective controller */

$routes = require_once "routes.php"; //get the routes

class Router {
    private $routes;
    public function __construct($routes)
    {
        /* app routes */
        $this->routes = $routes;
    }

    public function URL($url, $requestMethod) {
        /* Check if Routes Exits and return route page */
        if(array_key_exists($url, $this->routes[$requestMethod])) {
            return $this->routes[$requestMethod][$url]; 
        } else {
            return "controllers/notFound.php";
        }
    }
}

return new Router($routes);
?>