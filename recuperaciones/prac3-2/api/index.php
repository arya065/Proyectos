<?php
require "functions_serv.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->get("/example", function () {
    echo example();
});
$app->get("/example/{codigo}", function ($request) {
    echo getProductosCode($request->getAttribute("codigo"));
});
$app->put("/example/insertar", function ($request) {
    echo insertProducto($request->getParam("codigo"), $request->getParam("nombre"), $request->getParam("nombreCorto"), $request->getParam("descripcion"), $request->getParam("pvp"), $request->getParam("familia"));
});

$app->get("/login", function ($request) {
    // echo login($request->getParam("usuario"), $request->getParam("clave"));
    echo login("1", "1");
});
$app->get("/insertarUsuario", function ($request) {
    // $api_session = $request->getParam("api_session");
    // echo insertarUsuario($request->getParam("usuario"), $request->getParam("clave"), $request->getParam("email"), $api_session);
    echo insertarUsuario("3", "3", "3", "t53iqrkf07fh7jq6qjgcv8o213");
});
$app->get("/usuarios/{columna}/{valor}", function ($request) {
    // $api_session = $request->getParam("api_session");
    echo usuarios($request->getAttribute("columna"), $request->getAttribute("valor"), "t53iqrkf07fh7jq6qjgcv8o213");
});
$app->get("/comentarios/{id}", function ($request) {
    // $api_session = $request->getParam("api_session");
    echo comentarios($request->getAttribute("id"), "t53iqrkf07fh7jq6qjgcv8o213");
});
$app->get("/usuario/{id}", function ($request) { });
$app->get("/noticia/{id}", function ($request) { });
$app->get("/categoria/{id}", function ($request) { });
$app->get("/comentario/{id}", function ($request) { });
$app->get("/actualizarComentario/{id}", function ($request) { });
$app->get("/borrarComentario/{id}", function ($request) { });
$app->run();
