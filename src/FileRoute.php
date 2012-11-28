<?php

class FileRoute {
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
    
    public function valid($PUBLIC, $PATH_INFO, $REQUEST_METHOD) {
        if (!\preg_match($this->path, $PATH_INFO, $this->matches)) {
            return false;
        }

        if (\array_search(strtolower($REQUEST_METHOD), $this->methods->value(), true) === false) {
            return false;
        }
        
        $file = array_shift(\glob($PUBLIC.trim($this->matches['path'], '/'), \GLOB_BRACE));
        
        if (!$file || !\file_exists($file) || !\is_file($file)) {
            return false;
        }
        
        return true;
    }
    
    public function parameters() {
        $parameters = new Query($this->parameters->value());
        
        // 2. get parameters
        foreach ($this->matches as $key=>$value) {
            if (!\is_integer($key)) {
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
            $parameters[$key] = \strtr($value, $translates);
        }
        
        return $parameters;
    }
}
