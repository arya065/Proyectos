<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();
$app->setBasePath('/proyectos/testSlim4/public');

$app->get('/test', function (Request $request, Response $response, $args) {
    echo json_encode(array("hi"=>"there"));
    // $response->getBody()->write("Hello world!");
    return $response;
});
$app->get('/test2', function ($request,$response) {
    $response->getBody()->write(json_encode(array("hi"=>"there")));
    // return $response;
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();