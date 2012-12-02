<?php

namespace Dragon;

class ControllerRouterFactory implements RouterFactory {
    private $next;

    private $key;

    public function __construct($key='controller', RouterFactory $next = null) {
        $this->key = $key;

        $this->next = $next;
    }

    public function createRouter($config, RouterFactory $factory = null, Router $parent=null) {
        if (!isset($config->type) || $config->type === $this->key) {
            return new ControllerRouter($config, $factory !== null ? $factory : $this, $parent);
        }

        if ($this->next !== null) {
            return $this->next->createRouter($config, $factory, $parent);
        }

        throw new Exception;
    }
}
