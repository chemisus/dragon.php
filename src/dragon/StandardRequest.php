<?php

namespace Dragon;

class StandardRequest implements Request {
    private $path;

    private $method;

    public function path() {
        return $this->path;
    }

    public function method() {
        return $this->method;
    }

    public function __construct($path, $method) {
        $this->path = $path;

        $this->method = $method;
    }
}
