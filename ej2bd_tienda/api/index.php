<?php
require "functions_serv.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get("/productos", function () {
    echo getProductos();
});
$app->get("/producto/{codigo}", function ($request) {
    echo getProductosCode($request->getAttribute("codigo"));
});
$app->put("/producto/insertar", function ($request) {
});
$app->get("/producto/actualizar/{codigo}", function ($request) {
    echo updateProd($request->getAttribute("codigo"), "test2", "t2", "test desc2", 100.0, "CONSOL");
});
$app->delete("/producto/borrar/{codigo}", function ($request) {
});
$app->get("/familias", function ($request) {
});
$app->get("/repetido/{tabla}/{columna}/{valor}", function ($request) {
    echo repeated($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor"));
});
$app->get("/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}", function ($request) {
});

$app->run();
