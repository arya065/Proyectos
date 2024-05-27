<?php
require "funciones_serv.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


$app->get("/login", function ($request) {
    // echo login("profesor1", "123456");
    echo login($request->getParam("usuario"), $request->getParam("clave"));
});
$app->get("/logueado", function ($request) {
    echo logueado($request->getParam("api_session"));
});
$app->get("/salir", function ($request) {
    echo salir($request->getParam("api_session"));
});
$app->get("/usuario/{id_usuario}", function ($request) {
    echo usuario($request->getParam("api_session"), $request->getAttribute("id_usuario"));
});
$app->get("/usuariosGuardia/{dia}/{hora}", function ($request) {
    echo usuariosGuardia($request->getParam("api_session"), $request->getAttribute("dia"), $request->getAttribute("hora"));
});

$app->run();