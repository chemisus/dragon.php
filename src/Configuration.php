<?php
class Configuration {
    private $query;
    
    public function __construct($QueryFactory, $settings) {
        $this->query = $QueryFactory()->set(array($settings));
    }
    
    public function query() {
        return $this->query;
    }
}
