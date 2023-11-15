<?php
if (isset($_GET['id']) || isset($_POST["delete"])) {
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
    } else {
        $id = $_POST["delete"];
    }
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where id_usuario=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    //variables
    $line = mysqli_fetch_assoc($result);
    $usuario = $line["usuario"];
    $nombre = $line["nombre"];
    $img = $line["foto"];
    mysqli_close($conn);

    //delete button
    if (isset($_POST["delete"])) {
        try {
            $conn = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conn, "utf-8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        delete_user($conn, $id, $img);
        mysqli_close($conn);
        require ("index.php");
    }
}
function delete_user($conn, $id, $img)
{
    try {
        $consulta = "delete from usuarios where id_usuario=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    unlink("img/" . $img . "");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar usuario</title>
</head>

<body>
    <form action="delete.php" method="post">
        <p>Borrar usuario con:</p>
        <?php
        echo "<p>ID: $id</p>";
        echo "<p>Usuario: $usuario</p>";
        echo "<p>Nombre: $nombre</p>";
        echo "<p>Foto: $img</p>";
        ?>
        <a href="index.php"><button type="submit" value="<?php echo $id ?>" name="delete">Eliminar</button></a>
        <a href="index.php"><button type="button" value="Volver" name="back">Volver</button></a>
    </form>
</body>

</html>