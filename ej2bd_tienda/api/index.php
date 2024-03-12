<?php
require "functions_serv.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get("/productos", function () {
    echo getProductos();
});
$app->get("/producto/{codigo}", function ($request) {
    echo json_encode(array ("answer" => "here"));
});
$app->put("/producto/insertar/{nombre}", function ($request) {
});
$app->get("/producto/actualizar/{codigo}", function ($request) {
});
$app->delete("/producto/borrar/{codigo}", function ($request) {
});
$app->get("/repetido/{tabla}/{columna}/{valor}", function ($request) {
});
$app->get("/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}", function ($request) {
});

$app->run();
