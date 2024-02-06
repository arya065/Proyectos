<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Slim/autoload.php';
require "functions.php";
$app = new \Slim\App;

$app->get("/productos", function () {
    $conn = createConn();
    $response["message"] = $conn->query("SELECT * FROM productos")->fetchAll();
    echo json_encode($response);
    $conn = null;
});

$app->get("/producto/{codigo}", function ($request) {
    $conn = createConn();
    $value = $request->getAttribute("codigo");
    $sql = "SELECT * FROM productos WHERE codigo=?";
    $res = $conn->prepare($sql)->execute([$value]);
    echo json_encode(array("message" => ($res ? "existe" : "no existe")));
    $conn = null;
});

$app->put("/producto/insertar/{nombre}", function ($request) {
    $conn = createConn();
    $nombre = $request->getAttribute("nombre");
    $sql = "INSERT INTO productos (nombre) VALUES (?)";
    $res = $conn->prepare($sql)->execute([$nombre]);
    $conn = null;
    echo json_encode(array("message" => ($res == 1 ? "insertado correctamente producto con nombre $nombre" : "no insertado")));

});
$app->get("/producto/actualizar/{codigo}", function ($request) {
    $conn = createConn();
    $codigo = $request->getAttribute("codigo");
    $sql = "UPDATE productos SET nombre='nombreActualizar' WHERE codigo=?";
    $res = $conn->prepare($sql)->execute([$codigo]);
    $conn = null;
    echo json_encode(array("message" => ($res == 1 ? "actualizado correctamente producto con codigo $codigo" : "no actualizado")));
});
$app->delete("/producto/borrar/{codigo}", function ($request) {
    $conn = createConn();
    $codigo = $request->getAttribute("codigo");
    $sql = "DELETE FROM productos WHERE codigo=?";
    $res = $conn->prepare($sql)->execute([$codigo]);
    $conn = null;
    echo json_encode(array("message" => ($res == 1 ? "eleminado producto con codigo $codigo" : "no eliminado")));
});
$app->get("/repetido/{tabla}/{columna}/{valor}", function ($request) {
    $conn = createConn();
    $tabla = $request->getAttribute("tabla");
    $columna = $request->getAttribute("columna");
    $valor = $request->getAttribute("valor");
    if ($tabla == "productos" && ($columna == "codigo" || $columna == "nombre")) {
        $sql = "SELECT * FROM $tabla where $columna=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$valor]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        echo json_encode(array("message" => ($res != [] ? "existe" : "no existe")));
    }
});
// DESCRIBE `productos`;
$app->run();