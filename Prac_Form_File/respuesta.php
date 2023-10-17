<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas</title>
</head>

<body>
    <?php
    echo "<p>Nombre:", $_POST["nombre"], "</p>";
    echo "<p>Usuario:", $_POST["usuario"], "</p>";
    echo "<p>Contrasena:", $_POST["contrasena"], "</p>";
    echo "<p>DNI:", $_POST["dni"], "</p>";
    echo "<p>Sexo:", $_POST["sexo"], "</p>";
    // echo "<p>Foto:", $_FILES["photo"], "</p>";
    if (isset($_POST["sub"])) {
        echo "<p>Sub: si</p>";
    } else {
        echo "<p>Sub: no</p>";
    }
    ?>
</body>

</html>