<?php
require "funciones_web.php";
session_name("libreria");
session_start();



if (isset($_POST["enter"])) {
    $res = login($_POST["usuario"], $_POST["clave"]);
    // print_r($res);
    if (!isset($res->mensaje)) {
        $_SESSION["api_session"] = $res->api_session;
        $_SESSION["usuario"] = $res->usuario[0]->lector;
        $_SESSION["clave"] = $res->usuario[0]->clave;
        $_SESSION["tipo"] = $res->usuario[0]->tipo;
        $_SESSION["last_active"] = time();
        if ($_SESSION["tipo"] == "normal") {
            header("Location: views/normal.php");
        } else{
            header("Location: views/admin.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Libreria</h1>

    <form action="index.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" name="usuario" id="usuario">
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave">
        </p>
        <p>
            <button type="submit" name="enter" value="enter">Entrar</button>
        </p>
    </form>

    <h1>Listado de usuarios</h1>
    <table>
        here is table
    </table>
</body>

</html>