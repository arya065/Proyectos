<?php
require("../../function.php");
session_start();
if (!timeout() && stillExist($_SESSION["username"])) {
    if (isset($_POST["back"])) {
        header("Location: admin.php");
        return;
    }
    if (isset($_POST["send"])) {
        $errNombre = $errUsuario = $errClave = $errEmail = false;
        if ($_POST["nombre"] == "") {
            $errNombre =  true;
        }
        if ($_POST["usuario"] == "") {
            $errUsuario =  true;
        }
        if ($_POST["clave"] == "") {
            $errClave =  true;
        }
        if ($_POST["email"] == "") {
            $errEmail =  true;
        }
        $errForm = $errNombre || $errUsuario || $errClave || $errEmail;
        if (!$errForm) {
            createNewUser($_POST["nombre"], $_POST["usuario"], $_POST["clave"], $_POST["email"], $_POST["tipo"]);
            echo "Usuario creado con exito!";
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
        <form action="create.php" method="post">
            <h1>Nuevo Usuario</h1>
            <p><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["send"])) echo $_POST["nombre"] ?>"></p>
            <p><label for="usuario">Usuario:</label><input type="password" name="usuario" id="usuario" value="<?php if (isset($_POST["send"])) echo $_POST["usuario"] ?>"></p>
            <p><label for="clave">Clave:</label><input type="text" name="clave" id="clave" value="<?php if (isset($_POST["send"])) echo $_POST["clave"] ?>"></p>
            <p><label for="email">Email:</label><input type="text" name="email" id="email" value="<?php if (isset($_POST["send"])) echo $_POST["email"] ?>"></p>
            <p>
                <select name="tipo" id="tipo">
                    <option value="normal" <?php if (isset($_POST["send"]) && $_POST["tipo"] == "normal") echo "selected" ?>>Normal</option>
                    <option value="admin" <?php if (isset($_POST["send"]) && $_POST["tipo"] == "admin") echo "selected" ?>>Admin</option>
                </select>
            </p>
            <button type="submit" name="send">Continuar</button>
            <button type="submit" name="back">Volver</button>
        </form>
    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    return;
}
?>