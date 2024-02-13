<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require __DIR__ . '/Slim/autoload.php';
require "../conf.php";
require "../ej3/function.php";
// $configuration = [
//     'settings' => [
//         'displayErrorDetails' => true,
//         'outputBuffering' => false,
//         'addContentLengthHeader' => false
//     ],
// ];

// $app = new \Slim\App($configuration);
$app = new \Slim\App;


$app->get('/usuarios', function () {
    $conn = createConn();
    $sql = "SELECT * FROM usuarios";
    try {
        $stmt = $conn->prepare($sql);
        $tmp = $stmt->execute();
        // $stmt->debugDumpParams();
        // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

$app->get("/crearUsuario", function () {
    $conn = createConn();
    $sql = "SELECT * FROM usuarios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // $stmt->debugDumpParams();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("result" => $res));
    $conn = null;

});

$app->run();
