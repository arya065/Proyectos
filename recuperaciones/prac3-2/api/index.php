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
$app->run();
