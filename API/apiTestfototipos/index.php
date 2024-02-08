<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Slim/autoload.php';
require "./functions.php";
// $configuration = [
//     'settings' => [
//         'displayErrorDetails' => true,
//         'outputBuffering' => false,
//         'addContentLengthHeader' => false
//     ],
// ];

// $app = new \Slim\App($configuration);
$app = new \Slim\App;


$app->get('/take/all', function () {
    $answer["msg"] = getAll();
    echo json_encode($answer["msg"]);
});

$app->get('/take/{id}', function ($request) {
    $answer["msg"] = getWithId($request->getAttribute("id"));
    echo json_encode($answer["msg"]);
});

$app->get("/add/{points}/{id}", function ($request) {
    $answer["msg"] = json_decode(addToList($request->getAttribute("id"), $request->getAttribute("points")));
    echo json_encode($answer["msg"]);
});
$app->run();
