<?php

namespace Dragon;

class ControllerRoute implements Route {
    private $router;

    private $config;

    public function __construct($router, $config) {
        $this->router = $router;

        $this->config = $config;
    }

    public function execute() {
        print_r($this->router->parameters());
    }
}
