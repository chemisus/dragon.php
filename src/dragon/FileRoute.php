<?php

namespace Dragon;

class FileRoute implements Route {
    private $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    public function execute() {
        echo 'downloading '.$this->request->path();
    }
}