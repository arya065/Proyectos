<?php
require "./src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get('/login/{user}/{pass}', function ($request) {
    // $usuario = $request->getParam("usuario");
    // $clave = $request->getParam("clave");
    // echo json_encode(login("2", "2"));
    echo json_encode(login($request->getAttribute("user"), $request->getAttribute("pass")));
    ////////////////////////////////////////////////////
    // $tmp = json_encode(login("1", "1"));
    // if(json_decode($tmp)->api_session == ""){
    //     echo "not login";
    // } else{
    //     echo "login";
    // }
});

$app->get('/salir/{session}', function($request){
    echo json_encode(salir($request->getAttribute("session")));
});
$app->get('/logueado/{session}', function($request){
    echo json_encode(logueado($request->getAttribute("session")));
});

$app->get('/usuarios/{session}', function($request){
    echo json_encode(usuarios($request->getAttribute("session")));
});

$app->run();
?>
