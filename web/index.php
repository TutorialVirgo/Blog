<?php

require_once '../vendor/autoload.php';

use Virgo\Tutorial\Router\SimpleRouter;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$router = new SimpleRouter();
$router->getRoute($request->getPathInfo());

// controller
// response = controller($request)
// response->send()