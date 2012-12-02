<?php

namespace Dragon;

class ControllerRouter extends RouterTemplate {
    private $parameters;

    private $length;

    public function length() {
        return $this->length;
    }

    public function doParameters() {
        return $this->parameters;
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

    protected function doProcess(Request $request, $path) {
        $pattern = $this->pattern($this->config()->path);

        $subject = $path;

        $this->parameters = array();

        echo "\n".$pattern."\n";
        
        if (!preg_match('/^'.$pattern.'\/?/', $subject, $this->parameters)) {
            return false;
        }

        $this->length = strlen($this->parameters[0]);

        return true;
    }

    protected function doRoute(Request $request) {
        if (!isset($this->config()->page)) {
            return false;
        }

        return new ControllerRoute($this, $this->config());
    }
}
