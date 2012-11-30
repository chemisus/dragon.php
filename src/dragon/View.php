<?php

namespace dragon;

use \GLOB_BRACE;
use \call_user_func;

class View extends Vector {
    private $file;

    public function __construct($file, $data) {
        parent::__construct((array)$data);

        $this->file = $file;
    }

    public function __toString() {
        $__FILE__ = $this->file;

        $__DATA__ = $this->items();

        return call_user_func(function () use ($__FILE__, $__DATA__) {
            extract($__DATA__);

            ob_start();

            require(array_shift(glob($__FILE__, GLOB_BRACE)));

            return ob_get_clean();
        });
    }
}
