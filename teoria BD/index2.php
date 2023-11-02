<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("no he podido conectarse a la base de datos");
    }
    try {
        $consulta = "select * from usuarios";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("no se ha podido realizar consulta");
    }

    echo "<table>";
    echo "<tr>";
    echo "<td>" . $tupla["nombre"] . "</td>";
    echo "<td><img src='images/borrar.png' alt='borrar' title = 'Borrar Usuario'></td>";
    echo "<td><img src='images/editar.png' alt='editar' title = 'Editar Usuario'></td>";
    echo "</tr>";
    echo "</table>";

    echo "<form action='usuario_nuevo.php' method='post'>";
    echo '<input type="submit" value="Submit">';
    echo "</form>";
    ?>
</body>

</html>