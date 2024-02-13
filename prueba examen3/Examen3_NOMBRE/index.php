<?php
require("function.php");
session_start();
if (isset($_POST["enter"])) {
    if (!ifExist($_POST["usuario"], $_POST["clave"])) {
        $errForm = true;
    } else if (ifAdm($_POST["usuario"])) {
        $_SESSION["usuario"] = $_POST["usuario"];
        header("Location: admin/admin.php");
        return;
    } else {
        $_SESSION["usuario"] = $_POST["usuario"];
        header("Location: user.php");
        return;
    }
}
if (isset($_POST["reg"])) {
    header("Location: registration.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        span {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <?php
    if (isset($errForm) && $errForm) {
        echo '<span>*No existe usuario este*</span>';
    }
    ?>
    <form action="index.php" method="post">
        <p><label for="usuario">Nombre de usuario:</label><input type="text" name="usuario" id="usuario"></p>
        <p><label for="clave">Contrasena:</label><input type="text" name="clave" id="clave"></p>
        <button type="submit" name="enter">Entrar</button>
        <button type="submit" name="reg">Registrarse</button>
    </form>
</body>

</html>