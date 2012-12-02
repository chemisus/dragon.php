<?php

namespace Dragon;

use \Exception;

class FileRouterFactory implements RouterFactory {
    private $next;

    private $key;
    
    private $root;
    
    public function __construct($root, $key='file', RouterFactory $next = null) {
        $this->key = $key;
        
        $this->root = $root;

        $this->next = $next;
    }

    public function createRouter($config, RouterFactory $factory = null, Router $parent=null) {
        if (!isset($config->type) || $config->type === $this->key) {
            return new FileRouter($this->root, $config, $factory !== null ? $factory : $this, $parent);
        }

        if ($this->next !== null) {
            return $this->next->createRouter($config, $factory, $parent);
        }

        throw new Exception;
    }
}
