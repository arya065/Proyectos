<?php
session_name("cliente");
session_start();
require "funciones_cliente.php";

if (isset($_POST["registrar"]) && $_POST["registrar"] == "reg") {
    header("Location: registrar.php");
    return;
} else if (isset($_POST["entrar"]) && $_POST["entrar"] == "ent") {
    checkInput($_POST["usuario"], $_POST["clave"]);
}

function checkInput($user, $pass)
{
    if ($user == "" || $pass == "") {
        return false;
    } else {
        $response = json_decode(consumir_servicios_REST("/login", "GET", ["usuario" => $user, "clave" => $pass]));
        if (isset($response->api_session) && $response->api_session != "") {
            $_SESSION["api_session"] = $response->api_session;
            $_SESSION["usuario"] = $response->message->usuario;
            $_SESSION["tipo"] = $response->message->tipo;
            $_SESSION["current"] = 1;
            $_SESSION["itemPerPage"] = 2;
            print_r($response->message);
            if ($_SESSION["tipo"] == "normal") {
                header("Location: normal.php");
            } else {
                header("Location: admin.php");
            }
        }
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>

<body>
    <h1>Practica Rec2</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario">
        </p>
        <p>
            <label for="clave">Contrasena</label>
            <input type="text" name="clave" id="clave">
        </p>
        <p>
            <button type="submit" name="entrar" value="ent">Entrar</button>
            <button type="submit" name="registrar" value="reg">Registrarse</button>
        </p>
    </form>
</body>

</html>