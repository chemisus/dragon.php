<?php

namespace Dragon;

use \stdClass;
use \Exception;

require_once('src/dragon/Request.php');
require_once('src/dragon/Route.php');
require_once('src/dragon/Router.php');
require_once('src/dragon/RouterFactory.php');

require_once('src/dragon/RouterTemplate.php');

require_once('src/dragon/ControllerRoute.php');
require_once('src/dragon/ControllerRouter.php');
require_once('src/dragon/ControllerRouterFactory.php');
require_once('src/dragon/StandardRequest.php');

echo '<xmp>';

$request = new StandardRequest($_SERVER['PATH_INFO'], $_SERVER['REQUEST_METHOD']);

$factory = new ControllerRouterFactory();

$router = $factory->createRouter(json_decode(file_get_contents('config.json')));

$route = $router->route($request, $request->path());

$route->execute();

echo '</xmp>';
