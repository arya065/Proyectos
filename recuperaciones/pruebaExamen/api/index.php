<?php
require "functions_serv.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;


$app->get("/login", function () {
    echo login("test", "test");
});

$app->run();