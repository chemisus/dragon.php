<?php
class Vector implements ArrayAccess {
    private $items;
    
    public function __get($key) {
        return $this[$key];
    }
    
    public function __set($key, $value) {
        return $this[$key] = $value;
    }
    
    public function __construct($items=array()) {
        $this->items = $items;
    }
    
    public function offsetExists($offset) {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset) {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value) {
        return $this->items[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->items[$offset]);
    }
}
