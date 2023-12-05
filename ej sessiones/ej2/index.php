<?php
session_name("ej2");
session_start();
if (isset($_POST["send"])) {
    $_SESSION["username"] = $_POST["nombre"];
    header("Location: index2.php");
    print_r($_SESSION);
    exit;
}
if (isset($_POST["del"])) {
    session_destroy();
}
if (isset($_SESSION["username"])) {
    echo '<p>Su nombre es: <b>' . $_SESSION["username"] . '</b></p>';
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