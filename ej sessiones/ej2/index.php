<?php
session_name("ej1");
session_start();
if (isset($_POST["del"])) {
    session_destroy();
} else {


    if (isset($_POST["send"])) {
        $_SESSION["username"] = $_POST["nombre"];
        // session_destroy();
        header("Location: index2.php");
        exit;
    }
    if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
        echo '<p>Su nombre es: <b>' . $_SESSION["username"] . '</b></p>';
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
    <form action="index.php" method="post">
        <p>Escriba su nombre</p>
        <input type="text" name="nombre" id="nombre">
        <br>
        <input type="submit" value="Siguente" name="send">
        <input type="submit" value="Borrar" name="del">
    </form>

</body>

</html>