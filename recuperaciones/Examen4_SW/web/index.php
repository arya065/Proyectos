<?php
require "functions_clients.php";
session_name("client_session");
session_start();

if (isset($_POST["enter"]) && $_POST["usuario"] != "" && $_POST["clave"] != "") {
    $res = login($_POST["usuario"], $_POST["clave"]);

    if ($res->usuario == []) {
        session_destroy();
        header("Location: index.php");
    } else {
        print_r($res->usuario[0]);
        $_SESSION["usuario"] = $res->usuario[0]->usuario;
        $_SESSION["cod_usu"] = $res->usuario[0]->cod_usu;
        $_SESSION["api_session"] = $res->api_session;
        $_SESSION["last_active"] = time();

        if ($res->usuario[0]->tipo == "alumno") {
            header("Location: views/student.php");
        } else {
            header("Location: views/prof.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <h1>Notas de alumno</h1>
    <form action="index.php" method="post">
        <p>Usuario: <input type="text" name="usuario" id="usuario"></p>
        <p>Contrasena: <input type="password" name="clave" id="clave"></p>
        <p><button type="submit" name="enter" value="enter">Login</button></p>
    </form>
</body>

</html>