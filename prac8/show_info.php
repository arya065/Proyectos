<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    show_info($conn, $id);
    mysqli_close($conn);
}
function show_info($conn, $id)
{
    try {
        $consulta = "select * from usuarios where id_usuario = $id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    // print_r($result);
    $line = mysqli_fetch_assoc($result);
    echo '<p>ID: ' . $line["id_usuario"] . '</p>';
    echo '<p>Usuario: ' . $line["usuario"] . '</p>';
    echo '<p>Clave: ' . $line["clave"] . '</p>';
    echo '<p>Nombre: ' . $line["nombre"] . '</p>';
    echo '<p>DNI: ' . $line["dni"] . '</p>';
    echo '<p>Sexo: ' . $line["sexo"] . '</p>';
    echo '<p>Imagen: <img src = "img/' . $line["foto"] . '"alt="Foto usuario"></p>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar informacion</title>
    <style>
        img {
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>
</body>

</html>