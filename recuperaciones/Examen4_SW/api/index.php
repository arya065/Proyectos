<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

define("API_SESSION", "1m5ekc8a9s1upu316k96fka2dhefmcmk");

$app = new \Slim\App;

$app->get('/login', function ($request) {
    echo login("mperotr333", "123456");
});
$app->get('/logueado', function ($request) {
    echo logueado(API_SESSION);
});
$app->get('/salir', function ($request) {
    echo salir(API_SESSION);
});
$app->get('/alumnos', function ($request) {
    echo alumnos(API_SESSION);
});
$app->get('/notasAlumno', function ($request) {
    echo notasAlumno(API_SESSION, "1");
});
$app->get('/notasNoEvalAlumno', function ($request) {
    echo notasNoEvalAlumno(API_SESSION, "1");
});
$app->get('/quitarNota', function ($request) {
    echo quitarNota(API_SESSION, "1", "1");
});
$app->get('/ponerNota', function ($request) {
    echo ponerNota(API_SESSION, "1", "1");
});
$app->get('/cambiarNota', function ($request) {
    echo cambiarNota(API_SESSION, "1", "1", "5");
});


$app->run();