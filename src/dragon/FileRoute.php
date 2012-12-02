<?php

namespace Dragon;

class FileRoute implements Route {
    private $request;
    
    private $file;
    
    public function __construct(Request $request, $file) {
        $this->request = $request;
        
        $this->file = $file;
    }
    
    public function execute() {
        return file_get_contents($this->file);
    }
}