<?php

require_once '../vendor/autoload.php';

use Virgo\Tutorial\Controller\DefaultController;
use Virgo\Tutorial\Router\SimpleRouter;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$router = new SimpleRouter();

$controller = $router->getController($request->getPathInfo());
$response = call_user_func_array($controller, [$request]);
$response->send();
