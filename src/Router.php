<?php
class Router {
    /**
     *
     * @var \Query
     */
    private $routes;
    
    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function route($instance, $invoke) {
        foreach ($this->routes as $value) {
            $route = $instance($value->route, new Query($value));
            
            if ($invoke(array($route, 'valid'))) {
                return $route->parameters();
            }
        }
        
        return array();
    }
}
