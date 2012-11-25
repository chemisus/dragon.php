<?php
class Autoloader {
    private $SRC;
    
    public function __construct($SRC) {
        $this->SRC = $SRC;
    }
    
    public function load($class) {
        $tr = array('\\'=>'/');

        foreach (range('a', 'z') as $c) {
            $tr[$c] = '['.$c.strtoupper($c).']';
            $tr[strtoupper($c)] = '['.$c.strtoupper($c).']';
        }
        
        $path = strtr($class, $tr);

        $file = array_shift(glob($this->SRC.$path.'.php', GLOB_BRACE));

        if ($file === null) {
            throw new Exception("Could not load class {$class}.");
        }

        require_once($file);
    }
}
