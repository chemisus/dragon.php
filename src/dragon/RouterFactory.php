<?php

namespace Dragon;

interface RouterFactory {
    function createRouter($config, RouterFactory $factory=null, Router $parent=null);
}
