<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (!isset($_SESSION["nombre"])) {
        $_SESSION["nombre"] = "miguel santos";
        $_SESSION["clave"] = md5("123456");
    }
    ?>
    <p><a href="recibido.php">ver datos</a></p>

    <form action="recibido.php" method="post">
        <button type="submit" name="borrar">borrar</button>
    </form>
</body>

</html>