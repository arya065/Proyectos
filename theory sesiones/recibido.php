<?php
session_start();
if (isset($_POST["borrar"])) {
    session_destroy();
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
    <h2>se ha recibido:</h2>
    <p>
        <?php
        if (isset($_SESSION["nombre"])) {

            echo "nombre: " . $_SESSION["nombre"] . "<br>";
            echo "clave:  " . $_SESSION["clave"] . "<br>";
        } else {
            echo "<p>se han borrado</p>";
        }
        ?>
    </p>
    <p><a href="index.php">back</a></p>

</body>

</html>