<?php
require "functions_serv.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get("/example", function () {
    echo getProductos();
});
$app->get("/example/{codigo}", function ($request) {
    echo getProductosCode($request->getAttribute("codigo"));
});
$app->put("/example/insertar", function ($request) {
    echo insertProducto($request->getParam("codigo"), $request->getParam("nombre"), $request->getParam("nombreCorto"), $request->getParam("descripcion"), $request->getParam("pvp"), $request->getParam("familia"));
});

$app->get("/login", function () { });
$app->get("/insertarUsuario", function () { });
$app->get("/usuarios/{columna}/{valor}", function () { });
$app->get("/comentarios/{id}", function () { });
$app->get("/usuario/{id}", function () { });
$app->get("/noticia/{id}", function () { });
$app->get("/categoria/{id}", function () { });
$app->get("/comentario/{id}", function () { });
$app->get("/actualizarComentario/{id}", function () { });
$app->get("/borrarComentario/{id}", function () { });
$app->run();
