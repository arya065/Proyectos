<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(false, true, true);

$app->setBasePath('/Proyectos/testSlim4/public');


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/test/{name}/{surname}', function (Request $request, Response $response, $args) {
    echo json_encode(array ($request->getAttribute("name") => $request->getAttribute("surname")));
    return $response;
});
$app->get('/test2', function ($request, $response) {
    $response->getBody()->write(json_encode(array ("hi" => "there")));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();