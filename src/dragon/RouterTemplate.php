<?php

namespace Dragon;

abstract class RouterTemplate implements Router {
    private $config;

    private $factory;

    private $parent;

    public function parent() {
        return $this->parent;
    }

    public function config() {
        return $this->config;
    }

    public function factory() {
        return $this->factory;
    }

    public function routes() {
        if (!isset($this->config->routes)) {
            return array();
        }

        return $this->config->routes;
    }
    
    public function parameters() {
        $parameters = $this->doParameters();
        
        if ($this->parent() !== null) {
            $parameters = array_merge($this->parent()->parameters(), $parameters);
        }
        
        return $parameters;
    }

    public function __construct($config, RouterFactory $factory, Router $parent=null) {
        $this->config = $config;

        $this->factory = $factory;

        $this->parent = $parent;
    }

    public function route(Request $request, $path) {
        if (!$this->doProcess($request, $path)) {
            return false;
        }

        foreach ($this->routes() as $config) {
            $router = $this->factory()->createRouter($config, $this->factory, $this);

            $route = $router->route($request, substr($path, $this->length()));

            if ($route !== false) {
                return $route;
            }
        }

        return $this->doRoute($request);
    }
    
    abstract protected function doRoute(Request $request);
    
    abstract protected function doProcess(Request $request, $path);
    
    abstract protected function doParameters();
}
