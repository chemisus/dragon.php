<?php
class Query {
    private $items;
    
    public function get() {
        return $this->items;
    }
    
    public function one($index=0) {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        }
        
        return null;
    }
    
    public function set($value) {
        $this->items = $value;
        
        return $this;
    }
    
    public function __construct($value) {
        $this->items = $value;
    }
    
    public function map($func) {
        return new Query($func($this->items));
    }
    
    public function reduce($func, &$result) {
        $result = $func($this->items);
        
        return $this;
    }
    
    public function filter($func) {
        $array = array();

        foreach ($this->items as $key=>$value) {
            if ($func(new Query(array($value)), $key)) {
                $array[$key] = $value;
            }
        }
        
        return new Query($array);
    }
}
