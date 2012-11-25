<?php
class Request extends Vector {
    public function __construct($cookie, $env, $files, $get, $post,
        $server, $session, $input) {
        parent::__construct();
        
        $this->cookie = $cookie;
        
        $this->env = $env;
        
        $this->files = $files;
        
        $this->get = $get;
        
        $this->post = $post;
        
        $this->server = $server;
        
        $this->session = $session;
        
        $this->input = $input;
    }
}
