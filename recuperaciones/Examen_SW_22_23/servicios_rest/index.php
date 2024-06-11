<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->post("/login", function ($request) {
    echo login($request->getParam("usuario"),$request->getParam("clave"));
});
$app->get("/logueado", function ($request) {
    echo logueado($request->getParam("api_session"));
});
$app->post("/salir", function ($request) {
    echo salir($request->getParam("api_session"));
});
$app->get("/obtenerLibros", function ($request) {
    echo obtenerLibros($request->getParam("api_session"));
});
$app->post("/crearLibro", function ($request) {
    echo crearLibro($request->getParam("api_session"),$request->getParam("referencia"),$request->getParam("titulo"),$request->getParam("autor"),$request->getParam("descripcion"),$request->getParam("precio"),$request->getParam("portada"));
});
$app->put("/actalizarPortada/{referencia}", function ($request) {
    echo actualizarPortada($request->getParam("api_session"),$request->getParam("portada"),$request->getAttribute("referencia"));
});
$app->get("/repetido/{tabla}/{columna}/{valor}", function ($request) {
    echo repetido($request->getParam("api_session"),$request->getAttribute("tabla"),$request->getAttribute("columna"),$request->getAttribute("valor"));
});

// Una vez creado servicios los pongo a disposición
$app->run();
?>