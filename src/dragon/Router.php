<?php

namespace dragon;

class Router {
    private $routes;
    
    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function route($instance, $inject, $QueryFactory) {
        foreach ($this->routes as $value) {
            $route = $instance($value->route, $QueryFactory->invoke(array(
                $value
            )));
            
            if ($inject(array($route, 'valid'))) {
                return $inject(array($route, 'parameters'));
            }
        }
        
        return array();
    }
}
