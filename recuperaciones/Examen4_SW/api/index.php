<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';


$app = new \Slim\App;

$app->get('/login', function ($request) {
    echo login("masantos76", "123456");
    // echo login($request->getParam("usuario"), $request->getParam("clave"));
});
$app->get('/logueado', function ($request) {
    echo logueado($request->getParam("api_session"));
});
$app->get('/salir', function ($request) {
    echo salir($request->getParam("api_session"));
});
$app->get('/alumnos', function ($request) {
    echo alumnos($request->getParam("api_session"));
});
$app->get('/notasAlumno/{cod_alu}', function ($request) {
    echo notasAlumno($request->getParam("api_session"), $request->getAttribute("cod_alu"));
});
$app->get('/notasNoEvalAlumno/{cod_alu}', function ($request) {
    echo notasNoEvalAlumno($request->getParam("api_session"), $request->getAttribute("cod_alu"));
});
$app->get('/quitarNota/{cod_alu}', function ($request) {
    echo quitarNota($request->getParam("api_session"), $request->getAttribute("cod_alu"), $request->getParam("cod_asig"));
});
$app->get('/ponerNota/{cod_alu}', function ($request) {
    echo ponerNota($request->getParam("api_session"), $request->getAttribute("cod_alu"), $request->getParam("cod_asig"));
});
$app->get('/cambiarNota/{cod_alu}', function ($request) {
    echo cambiarNota($request->getParam("api_session"), $request->getAttribute("cod_alu"), $request->getParam("cod_asig"), $request->getParam("nota"));
});


$app->run();