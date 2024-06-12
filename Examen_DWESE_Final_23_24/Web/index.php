<?php
require "src/funciones_ctes.php";


session_name("Examen_Final_DWESE_23_24");
session_start();

if (isset($_POST["enter"])) {
    $res = login($_POST["usuario"], $_POST["clave"]);
    if (!isset($res->mensaje)) {
        print_r($res);
        $_SESSION["id_usuario"] = $res->usuario[0]->id_usuario;
        $_SESSION["usuario"] = $res->usuario[0]->usuario;
        $_SESSION["nombre"] = $res->usuario[0]->nombre;
        $_SESSION["clave"] = $res->usuario[0]->clave;
        $_SESSION["tipo"] = $res->usuario[0]->tipo;
        $_SESSION["api_session"] = $res->api_session;
        $_SESSION["last_active"]=time();
        if($_SESSION["tipo"] == "admin"){
            header("Location: views/vista_admin.php");
        } else{
            header("Location: views/vista_normal.php");
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
    <style>
        .err {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Login</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["enter"]) && $_POST["usuario"] != "")
                echo $_POST["usuario"] ?>">
            </p>
            <?php
            if (isset($_POST["enter"]) && $_POST["usuario"] == "") {
                echo '<span class="err">*Campo vacio*</span>';
            }
            ?>
        <p>
            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave">
        </p>
        <?php
        if (isset($_POST["enter"]) && $_POST["clave"] == "") {
            echo '<span class="err">*Campo vacio*</span>';
        }
        ?>
        <p>
            <button type="submit" name="enter" value="enter">Entrar</button>
        </p>
    </form>
</body>

</html>