<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->run();
// Fatal error: Uncaught Slim\Exception\HttpNotFoundException: Not found. in C:\OSPanel\domains\Proyectos\testSlim4-2\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php:76 Stack trace: #0 C:\OSPanel\domains\Proyectos\testSlim4-2\vendor\slim\slim\Slim\Routing\RouteRunner.php(56): Slim\Middleware\RoutingMiddleware->performRouting() #1 C:\OSPanel\domains\Proyectos\testSlim4-2\vendor\slim\slim\Slim\MiddlewareDispatcher.php(65): Slim\Routing\RouteRunner->handle() #2 C:\OSPanel\domains\Proyectos\testSlim4-2\vendor\slim\slim\Slim\App.php(199): Slim\MiddlewareDispatcher->handle() #3 C:\OSPanel\domains\Proyectos\testSlim4-2\vendor\slim\slim\Slim\App.php(183): Slim\App->handle() #4 C:\OSPanel\domains\Proyectos\testSlim4-2\public\index.php(15): Slim\App->run() #5 {main} thrown in C:\OSPanel\domains\Proyectos\testSlim4-2\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php on line 76