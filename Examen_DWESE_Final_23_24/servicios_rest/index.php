<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;


$app->post('/login', function ($request) {
    echo login($request->getParam("usuario"), $request->getParam("clave"));
});
$app->get('/logueado', function ($request) {
    echo logueado($request->getParam("api_session"));
});
$app->post('/salir', function ($request) {
    echo salir($request->getParam("api_session"));
});
$app->get('/horarioProfesor/{id_usuario}', function ($request) {
    echo horarioProfesor($request->getParam("api_session"), $request->getAttribute("id_usuario"));
});
$app->get('/horarioGrupo/{id_grupo}', function ($request) {
    echo horarioGrupo($request->getParam("api_session"), $request->getAttribute("id_grupo"));
});
$app->get('/grupos', function ($request) {
    echo grupos($request->getParam("api_session"));
});
$app->get('/aulas', function ($request) {
    echo aulas($request->getParam("api_session"));
});
$app->get('/profesores/{dia}/{hora}/{id_grupo}', function ($request) {
    echo profesores($request->getParam("api_session"), $request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_grupo"));
});
$app->get('/profesoresLibres/{dia}/{hora}/{id_grupo}', function ($request) {
    echo profesoresLibres($request->getParam("api_session"), $request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_grupo"));
});
$app->delete('/borrarProfesor/{dia}/{hora}/{id_grupo}/{id_usuario}', function ($request) {
    echo borrarProfesor($request->getParam("api_session"), $request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_grupo"), $request->getAttribute("id_usuario"));
});
$app->post('/insertarProfesor/{dia}/{hora}/{id_grupo}/{id_usuario}/{id_aula}', function ($request) {
    echo insertarProfesor($request->getParam("api_session"), $request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_grupo"), $request->getAttribute("id_usuario"), $request->getAttribute("id_aula"));
});
$app->run();
