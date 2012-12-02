<?php

namespace Dragon;

require_once('Dragon.php');

echo '<xmp>';

class Container implements ControllerContainer {
    public function executeController($controller, $action, $parameters) {
        echo $controller. ' ' . $action;
    }
}

$request = new DefaultRequest($_SERVER['PATH_INFO'], $_SERVER['REQUEST_METHOD']);

$factory = new ControllerRouterFactory(
    new Container(),
    'standard',
    new FileRouterFactory()
);

$router = $factory->createRouter(json_decode(file_get_contents('config.json')));

$route = $router->route($request, $request->path());

$route->execute();

echo '</xmp>';
