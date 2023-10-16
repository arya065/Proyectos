<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de Datos</title>
</head>

<body>
    <h1>Recogiendo los datos</h1>
    <?php
    echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
    echo "<p><strong>Apellidos </strong>" . $_POST["apellidos"] . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $_POST["clave"] . "</p>";
    echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";


    echo "<p><strong>Nacido: </strong>" . $_POST["nacido"] . "</p>";

    echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
    if (isset($_POST["subscripcion"]))
        echo "<p><strong>Subscripción:</strong>Si</p>";
    else
        echo "<p><strong>Subscripción:</strong>No</p>";

    ?>
</body>

</html>