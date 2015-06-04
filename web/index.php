<?php

require_once '../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Virgo\Tutorial\Controller\RegistrationController;
use Virgo\Tutorial\Router\SimpleRouter;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
/*
$router = new SimpleRouter();
$controller = $router->getController($request->getPathInfo());
$response = call_user_func_array($controller, [$request]);
$response->send();
*/

$locator = new FileLocator([__DIR__ . '/Virgo/Tutorial/Resources/Routing/']);
$requestContext = new RequestContext($_SERVER['REQUEST_URI']);

$router = new Router(
    new YamlFileLoader($locator),
    'routes.yml',
    ['cache_dir' => __DIR__ . '/cache'],
    $requestContext
);
$router->match($request->getPathInfo());
