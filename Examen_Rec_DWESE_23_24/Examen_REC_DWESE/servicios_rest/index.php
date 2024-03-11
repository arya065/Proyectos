<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;




$app->get('/login', function ($request) {
    $usuario = $request->getParam("usuario");
    $clave = md5($request->getParam("clave"));
    echo json_encode(login($usuario, $clave));
});


$app->get('/salir', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    session_destroy();
    echo json_encode(array ("log_out" => "Cerrada sesión en la API"));
});

$app->get('/logueado', function ($request) {
    $api_session = $request->getParam("api_session");
    echo json_encode(logueado($api_session));
});

$app->get('/usuario/{id_usuario}', function ($request) {
    $api_session = $request->getParam("api_session");
    $id = $request->getAttribute("id_usuario");
    echo json_encode(getUser($api_session, $id));
});
$app->get('/usuariosGuardia/{dia}/{hora}', function ($request) {
    $api_session = $request->getParam("api_session");
    $dia = $request->getAttribute("dia");
    $hora = $request->getAttribute("hora");
    echo json_encode(getGuardia($api_session, $dia, $hora));
});


$app->run();
?>