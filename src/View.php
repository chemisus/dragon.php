<?php
class View {
    private $file;
    
    private $data;
    
    public function __construct($file, $data) {
        $this->file = $file;
        
        $this->data = $data;
    }
    
    public function render() {
        $__FILE__ = $this->file;
        
        $__DATA__ = $this->data;
        
        $render = function () use ($__FILE__, $__DATA__) {
            extract($__DATA__);
            
            ob_start();
            
            require($__FILE__);
            
            return ob_get_clean();
        };
        
        return $render();
    }
    
    public function __toString() {
        return $this->render();
    }
}
