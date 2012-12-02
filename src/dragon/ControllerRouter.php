<?php

namespace Dragon;

class ControllerRouter extends RouterTemplate {
    private $parameters;

    private $length;
    
    private $container;

    public function length() {
        return $this->length;
    }
    
    public function __construct($config, RouterFactory $factory, Router $parent = null, ControllerContainer $container) {
        parent::__construct($config, $factory, $parent);
        
        $this->container = $container;
    }

    public function pattern($pattern) {
        $pattern = preg_replace(
            array(
                '/\//',
                '/\./',
                '/#/',
                '/@/',
                '/\[([^\]]+)\]/',
                '/\*/',
                '/<([^\>,]+)(?:,([^\>]+))?>/',
            ),
            array(
                '\\/',
                '\\\.',
                '\\d',
                '\\w',
                '(?:${1})',
                '[^\/]',
                '(?P<${1}>${2})',
            ),
            $pattern
        );

        return $pattern;
    }

    protected function doParameters($parameters) {
        $parameters = array_merge($parameters, $this->parameters);
        
        $transforms = array();
        
        foreach ($parameters as $key=>$value) {
            $transforms["<{$key}>"] = $value;
        }
        
        if (isset($this->config()->values)) {
            foreach ($this->config()->values as $key=>$value) {
                $parameters[$key] = strtr($value, $transforms);
            }
        }
        
        return $parameters;
    }
    
    protected function doProcess(Request $request, $path) {
        $pattern = $this->pattern($this->config()->path);

        $subject = $path;

        $this->parameters = array();

        if (!preg_match('/^'.$pattern.'\/?/', $subject, $this->parameters)) {
            return false;
        }

        $this->length = strlen($this->parameters[0]);

        return true;
    }

    protected function doRoute(Request $request) {
        if (!isset($this->config()->values)) {
            return false;
        }

        return new ControllerRoute($this, $this->config(), $this->container);
    }
}
