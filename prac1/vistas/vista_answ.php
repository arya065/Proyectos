<!-- полученные данные из формы -->
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
    echo "<p><strong>Nombre: </strong>" . $_POST["name"] . "</p>";
    echo "<p><strong>Nacido en: </strong>" . $_POST["birth"] . "</p>";
    echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";

    if (isset($_POST["hobby"])) {
        echo "<p><strong>Aficiones:</strong>Si</p>";
    } else {
        echo "<p><strong>Aficiones:</strong>No</p>";
    }

    if ($_POST["comment"] !== "") {
        echo "<p><strong>Comentarios: </strong>" . $_POST["comment"] . "</p>";
    } else {
        echo "<p>No has hecho ningun comentario</p>";
    }


    ?>
</body>

</html>