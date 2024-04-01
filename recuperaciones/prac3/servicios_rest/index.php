<?php
require "./src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get('/login', function ($request) {
    // $usuario = $request->getParam("usuario");
    // $clave = $request->getParam("clave");
    echo json_encode(login("1", "1"));
    // echo json_encode(login($usuario, $clave));
});

$app->get('/salir/{session}', function($request){
    echo json_encode(salir($request->getAttribute("session")));
});
$app->get('/logueado/{session}', function($request){
    echo json_encode(logueado($request->getAttribute("session")));
});
$app->run();
?>
