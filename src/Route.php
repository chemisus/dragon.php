<?php
class Route {
    private $route;
    
    public function __construct($route) {
        $this->route = $route;
    }
    
    public function check($inject, $instance, $PATH_INFO, $REQUEST_METHOD) {
        $matches = array();
        
        if (!\preg_match($this->route['path'], $PATH_INFO, $matches)) {
            return false;
        }

        if (count($this->route['method']) && array_search(strtolower($REQUEST_METHOD), $this->route['method']) === false) {
            return false;
        }
        
        foreach ($this->route['permissions'] as $array) {
            $permission = $instance($array['class']);
            
            if (!$inject(array($permission, $array['method']), $array['args'])) {
                if (isset($array['failed']) && $array['failed']) {
                    return $array['failed'];
                }
                
                return false;
            }
        }
        
        $values = array_merge(
            $this->route['args'],
            $matches,
            array('path'=>$PATH_INFO, 'method'=>$REQUEST_METHOD)
        );

        $controller = $this->route['controller'];
        
        $action = $this->route['action'];
        
        foreach ($values as $key=>$value) {
            $controller = \str_replace("<{$key}>", $value, $controller);

            $action = \str_replace("<{$key}>", $value, $action);
        }
        
        return array_merge(
            $this->route,
            $values, 
            array('controller'=>$controller, 'action'=>$action)
        );
    }
}
