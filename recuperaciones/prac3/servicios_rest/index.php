<?php
require "./src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get('/login', function ($request) {
    // $usuario = $request->getParam("usuario");
    // $clave = $request->getParam("clave");
    echo json_encode(login("2", "2"));
    // echo json_encode(login($request->getAttribute("user"), $request->getAttribute("pass")));
});

$app->get('/salir/{session}', function ($request) {
    echo json_encode(salir($request->getAttribute("session")));
});

$app->get('/logueado/{session}', function ($request) {
    echo json_encode(logueado($request->getAttribute("session")));
});

$app->get('/usuarios/{session}', function ($request) {
    echo json_encode(usuarios($request->getAttribute("session")));
});

$app->get('/registrar/{session}/{usuario}/{clave}/{nombre}/{dni}/{sexo}/{foto}/{subscripcion}/{tipo}', function ($request) {
    echo json_encode(registrar($request->getAttribute("session"), $request->getAttribute("usuario"), $request->getAttribute("clave"), $request->getAttribute("nombre"), $request->getAttribute("dni"), $request->getAttribute("sexo"), $request->getAttribute("foto"), $request->getAttribute("subscripcion"), $request->getAttribute("tipo")));
    // http://localhost/Proyectos/recuperaciones/prac3/servicios_rest/registrar/2r1gveh5nfe0kh1c6a373ovr6v/5/5/5/5/hombre/no_imagen.png/0/admin
});

$app->get('/paginacion/{session}/{page}/{num}', function ($request) {
    echo json_encode(paginacion($request->getAttribute("session"), $request->getAttribute("page"), $request->getAttribute("num")));
});

$app->get('/usuario/{session}/{id}', function ($request) {
    echo json_encode(usuario($request->getAttribute("session"), $request->getAttribute("id")));
});

$app->get('/borrar/{session}/{id}', function ($request) {
    echo json_encode(borrar($request->getAttribute("session"), $request->getAttribute("id")));
});

$app->get('/editar/{session}/{id}/{usuario}/{clave}/{nombre}/{dni}/{sexo}/{foto}/{subscripcion}/{tipo}', function ($request) {
    echo json_encode(editar($request->getAttribute("session"), $request->getAttribute("id"), $request->getAttribute("usuario"), $request->getAttribute("clave"), $request->getAttribute("nombre"), $request->getAttribute("dni"), $request->getAttribute("sexo"), $request->getAttribute("foto"), $request->getAttribute("subscripcion"), $request->getAttribute("tipo")));
});

$app->run();
?>