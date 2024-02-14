<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require __DIR__ . '/Slim/autoload.php';
require "../conf.php";
require "../ej4/function.php";
// $configuration = [
//     'settings' => [
//         'displayErrorDetails' => true,
//         'outputBuffering' => false,
//         'addContentLengthHeader' => false
//     ],
// ];

// $app = new \Slim\App($configuration);
$app = new \Slim\App;


$app->get('/usuarios', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = [];
        foreach ($stmt as $value) {
            $res[] = $value;
        }
        echo json_encode(array("usuarios" => $res));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get("/crearUsuario", function ($request) {
    try {
        $conn = createConn();
        // $nombre = $request->getParam("nombre");
        // $usuario = $request->getParam("usuario");
        // $clave = $request->getParam("clave");
        // $email = $request->getParam("email");

        $sql = "INSERT INTO usuarios (nombre,usuario,clave,email) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["test", "test", md5("test"), "test"]);
        echo json_encode(array("result" => $conn->lastInsertId()));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;

});

$app->get("/login", function ($request) {
    try {
        $conn = createConn();
        // $usuario = $request->getParam("usuario");
        // $clave = $request->getParam("clave");
        $sql = "SELECT id_usuario FROM usuarios WHERE usuario=? AND clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["test", md5("test")]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("result" => $res[0]["id_usuario"]));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
});
$app->get("/borrarUsuario/{idUsuario}", function ($request) {
    try {
        $conn = createConn();
        $usuario = $request->getAttribute("idUsuario");
        $sql = "DELETE FROM usuarios WHERE id_usuario=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario]);
        echo json_encode(array("result" => $stmt->rowCount() == 0 ? "no eliminado" : "eliminado con exito"));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
});

$app->run();
