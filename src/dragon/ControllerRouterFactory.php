<?php

namespace Dragon;

use \Exception;

class ControllerRouterFactory implements RouterFactory {
    private $next;

    private $key;
    
    private $container;

    public function __construct(ControllerContainer $container, $key='controller', RouterFactory $next = null) {
        $this->key = $key;

        $this->next = $next;
        
        $this->container = $container;
    }

    public function createRouter($config, RouterFactory $factory = null, Router $parent=null) {
        if (!isset($config->type) || $config->type === $this->key) {
            return new ControllerRouter($config, $factory !== null ? $factory : $this, $parent, $this->container);
        }

        if ($this->next !== null) {
            return $this->next->createRouter($config, $factory, $parent);
        }

        throw new Exception;
    }
}
