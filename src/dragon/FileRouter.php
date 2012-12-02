<?php

namespace Dragon;

class FileRouter extends RouterTemplate {
    private $file;
    
    public function __construct($root, $config, RouterFactory $factory, Router $parent=null) {
        parent::__construct($config, $factory, $parent);
        
        $this->root = $root;
    }
    
    protected function doProcess(Request $request, $path) {
        $pattern = '/'.trim($this->root, '/').'/'.trim($request->path(), '/');
        
        $this->file = array_shift(glob($pattern, GLOB_BRACE));
        
        if ($this->file === null) {
            return false;
        }
        
        return true;
    }

    protected function doRoute(Request $request) {
        return new FileRoute($request, $this->file);
    }

    public function length() {
        return 1;
    }
}