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
    echo insertProducto($request->getParam("codigo"), $request->getParam("nombre"), $request->getParam("nombreCorto"), $request->getParam("descripcion"), $request->getParam("pvp"), $request->getParam("familia"));
});
$app->get("/producto/actualizar/{codigo}", function ($request) {
    echo updateProd($request->getParam("codigo"), $request->getParam("nombre"), $request->getParam("nombreCorto"), $request->getParam("descripcion"), $request->getParam("pvp"), $request->getParam("familia"));
});
$app->delete("/producto/borrar/{codigo}", function ($request) {
    echo delProd($request->getAttribute("codigo"));
});
$app->get("/familias", function ($request) {
    echo getFamilias();
});
$app->get("/repetido/{tabla}/{columna}/{valor}", function ($request) {
    echo repeated($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor"));
});
$app->get("/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}", function ($request) {
    echo repeatedEdit($request->getAttribute("tabla"), $request->getAttribute("columna"), $request->getAttribute("valor"), $request->getAttribute("columna_id"), $request->getAttribute("valor_id"));
});

$app->run();
