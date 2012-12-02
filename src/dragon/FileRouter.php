<?php

namespace Dragon;

class FileRouter extends RouterTemplate {
    public function __construct($root, $config, RouterFactory $factory, Router $parent=null) {
        parent::__construct($config, $factory, $parent);
        
        $this->root = $root;
    }
    
    protected function doProcess(Request $request, $path) {
        if (!is_file($this->root.$request->path())) {
            return false;
        }
        
        return true;
    }

    protected function doRoute(Request $request) {
        return new FileRoute($request);
    }

    public function length() {
        return 1;
    }
}