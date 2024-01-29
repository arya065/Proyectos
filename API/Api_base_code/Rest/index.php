<?php

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->get('/saludo/{codigo}', function ($request) {

    //$datos["cod"]=$request->getParam('cod');
    $response["message"] = "Hi," . $request->getAttribute('codigo') . ". Second request";
    echo json_encode($response);
});
$app->get('/saludo', function ($request) {
    $answer["message"] = "Hello request";
    echo json_encode($answer);
});

// Una vez creado servicios los pongo a disposición
$app->run();
