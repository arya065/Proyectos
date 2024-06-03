<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;



$app->get('/conexion_PDO', function ($request) {
    echo json_encode(conexion_pdo());
});
$app->get('/login', function ($request) {
    echo "login";
});


$app->run();