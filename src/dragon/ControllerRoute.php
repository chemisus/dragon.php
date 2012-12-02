<?php

namespace Dragon;

class ControllerRoute implements Route {
    private $router;

    private $config;
    
    private $container;

    public function __construct($router, $config, $container) {
        $this->router = $router;

        $this->config = $config;
        
        $this->container = $container;
    }

    public function execute() {
        $parameters = $this->router->parameters();
        
        $this->container->executeController(
            $parameters['controller'],
            $parameters['action'],
            $this->router->parameters()
        );
    }
}
