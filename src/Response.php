<?php
class Response {
    private $request;

    private $route;
    
    private $controller;

    public function __construct(
            $instance,
            $request,
            $route) {
        
        $this->request = $request;

        $this->route = $route;
        
        $this->controller = $instance($route['controller']);
    }
    
    public function redirect($url) {
        header("Location: {$url}");
        
        session_write_close();
        
        die();
    }

    public function render($inject) {
        try
        {
            $value = $inject(array($this->controller, $this->route['action']));

            return (string)$value;
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }

        return '';
    }
}
