<?php

namespace Dragon;

interface ControllerContainer {
    function executeController($controller, $action, $parameters);
}
