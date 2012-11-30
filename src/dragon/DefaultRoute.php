<?php

namespace dragon;

use \preg_match;
use \array_search;
use \is_integer;
use \strtr;

class DefaultRoute {
    private $matches = array();
    
    private $methods;
    
    private $parameters;
    
    private $translates;
    
    public function __construct($path, $methods, $parameters, $translates) {
        $this->path = $path;
        
        $this->methods = $methods;

        $this->parameters = $parameters;
        
        $this->translates = $translates;
    }
    
    public function valid($PATH_INFO, $REQUEST_METHOD) {
        if (!preg_match($this->path, $PATH_INFO, $this->matches)) {
            return false;
        }

        if (array_search(strtolower($REQUEST_METHOD), $this->methods->value(), true) === false) {
            return false;
        }
        
        return true;
    }
    
    public function parameters($QueryFactory) {
        $parameters = $QueryFactory->invoke(array(
            'value' => $this->parameters->value())
        );
        
        // 2. get parameters
        foreach ($this->matches as $key=>$value) {
            if (!is_integer($key)) {
                $parameters[$key] = $value;
            }
        }

        // 3. get translates
        $translates = array();

        foreach ($this->parameters as $key=>$value) {
            $translates['<'.$key.'>'] = $value;
        }

        // 4. translate parameters
        foreach ($this->translates as $key=>$value) {
            $parameters[$key] = strtr($value, $translates);
        }
        
        return $parameters;
    }
}
