<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Slim/autoload.php';
require "functions.php";
$app = new \Slim\App;

$app->get("/productos", function () {
    $conn = createConn();
    $response["message"] = $conn->query("select * from productos")->fetchAll();
    echo json_encode($response);
    $conn = null;
});

$app->get("/producto/{codigo}", function ($request) {
    $conn = createConn();
    $value = $request->getAttribute("codigo");
    $response["message"] = $conn->query("select * from productos where codigo=$value")->fetchAll();
    echo json_encode($response);
    $conn = null;
});

$app->put("/producto/insertar/{nombre}", function ($request) {
    $conn = createConn();
    // $nombre = $request->getParam("nombre");
    $nombre = $request->getAttribute("nombre");
    $res = $conn->exec("insert into productos (nombre) values ('$nombre')");
    $conn = null;
    echo json_encode(array("mensaje" => ($res == 1 ? "insertado" : "no insertado")));

});

$app->run();