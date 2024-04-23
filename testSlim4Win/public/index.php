<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();
$app->setBasePath('/proyectos/testSlim4Win/public');

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello Slim!");
    return $response;
});
$app->get('/test', function (Request $request, Response $response, $args) {
    echo json_encode(array ("hi" => "there"));
    // $response->getBody()->write("Hello world!");
    return $response;
});
$app->get('/test2', function ($request, $response) {
    $response->getBody()->write(json_encode(array ("hi" => "there")));
    // return $response;
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();

/*
Uncaught Slim\Exception\HttpNotFoundException: Not found.
in C:\OSPanel\domains\Proyectos\testSlim4\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php:76 
Stack trace: #0 C:\OSPanel\domains\Proyectos\testSlim4\vendor\slim\slim\Slim\Routing\RouteRunner.php(56):
Slim\Middleware\RoutingMiddleware->performRouting() #1 C:\OSPanel\domains\Proyectos\testSlim4\vendor\slim\slim\Slim\MiddlewareDispatcher.php(65):
Slim\Routing\RouteRunner->handle() #2 C:\OSPanel\domains\Proyectos\testSlim4\vendor\slim\slim\Slim\App.php(199): 
Slim\MiddlewareDispatcher->handle() #3 C:\OSPanel\domains\Proyectos\testSlim4\vendor\slim\slim\Slim\App.php(183): 
Slim\App->handle() #4 C:\OSPanel\domains\Proyectos\testSlim4\public\index.php(25): 
Slim\App->run() #5 {main} thrown in C:\OSPanel\domains\Proyectos\testSlim4\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php on line 76
*/

/**
 * additional info:
 * composer version: 2.2.6
 * 
 * возможно стоит сделать так:
 * // Установка базового пути для вашего приложения на Windows
 *$basePath = realpath(__DIR__ . '/..'); // Путь к корневой директории проекта
 * // Подключение автозагрузчика Composer
 *require $basePath . '/vendor/autoload.php';
 
 */