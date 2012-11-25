<?php
class Router {
    private $routes;
    
    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function route(
            $RouteFactory,
            $inject) {

        foreach ($this->routes as $route) {
            $match = $inject(
                array($RouteFactory(array('route'=>$route)), 'check'),
                array('route'=>$route)
            );
            
            if (!empty($match)) {
                return $match;
            }
        }
    }
}
