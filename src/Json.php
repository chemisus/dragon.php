<?php
class Json {
    public function load($json) {
        return json_decode($json);
    }
    
    public function save($object) {
        return json_encode($object);
    }
}
