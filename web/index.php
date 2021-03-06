<?php

require_once '../vendor/autoload.php';
require_once '../bootstrap.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Virgo\Tutorial\Controller\Resolver\ControllerResolver;
use Symfony\Component\HttpFoundation\Request;
use Virgo\Tutorial\Service\AuthenticationService;

$request = Request::createFromGlobals();
$request->setSession($session);

$locator = new FileLocator([dirname(__DIR__) . '/src/Virgo/Tutorial/Resources/Routing']);
$requestContext = new RequestContext($_SERVER['REQUEST_URI']);

$router = new Router(
    new YamlFileLoader($locator),
    'routes.yml',
    ['cache_dir' => __DIR__ . '/cache'],
    $requestContext
);

$result = $router->match($request->getPathInfo());
$controller = (new ControllerResolver())->resolve($result["_controller"], $entityManager);
$response = call_user_func_array($controller, [$request]);
$response->send();
