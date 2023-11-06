<?php
if (isset($_POST["go_insert"])) {
    require "usuario_nuevo.php";
    return;
}
function getUsers()
{
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuarios</title>
</head>

<body>
    <h1>Listado de los usuarios</h1>
    <table border="1">
        <tr>
            <th>Nombre de usuario</th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php
        $list = getUsers();
        foreach ($list as $i => $value) {
            $line = mysqli_fetch_assoc($list);
            echo '<td><a>' . $line[$i] . '</a></td>';
        }
        ?>
    </table>
    <form action="index.php" method="post">
        <input type="submit" value="Insertar nuevo Usuario" name="go_insert">
    </form>
</body>

</html>