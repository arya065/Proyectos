<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


$app->get('/', function () {
    echo $respuesta["message"] = "no data";
    // echo json_encode($respuesta);
});

$app->get('/test', function ($request, $response) {
    $response->getBody()->write(json_encode(array ("hi" => "there")));
    print_r(gettype($response));
    echo "<br/>";
    print_r($response->getBody());
    return $response;
    // return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
