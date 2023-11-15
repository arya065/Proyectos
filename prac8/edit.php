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

    // echo '<form action="index.php" method="post">';
    // echo '<p>ID: ' . $line["id_usuario"] . '</p>';
    // echo '<p>Usuario: ' . $line["usuario"] . '</p>';
    // echo '<p>Clave: ' . $line["clave"] . '</p>';
    // echo '<p>Nombre: ' . $line["nombre"] . '</p>';
    // echo '<p>DNI: ' . $line["dni"] . '</p>';
    // echo '<p>Sexo: ' . $line["sexo"] . '</p>';
    // echo '<p>Imagen: <img src = "img/' . $line["foto"] . '"alt="Foto usuario"></p>';
    // echo '<button><a href="index.php">Volver</a></button>';
    // echo '</form>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <style>
        img {
            height: 100px;
            width: 100px;
        }

        a {
            color: black;
            text-decoration: none;
        }

        a:visited {
            color: black;
        }
    </style>
</head>

<body>
    <form action="edit.php" method="post">
        <p>
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" placeholder="___">
        </p>
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" placeholder="___">
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave" placeholder="___">
        </p>
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="___">
        </p>
        <p>
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" placeholder="___">
        </p>
        <p>
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option hidden>Default</option>
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
            </select>
        </p>
        <p>
            <label for="img">Imagen:</label>
            <input type="file" name="img" id="img">
            <!-- если значение пустое, то не меняем, вообще так надо для каждого из полей сделать -->
        </p>
        <button><a href="index.php">Volver</a></button>

    </form>

</body>

</html>