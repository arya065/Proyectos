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
function deleteUser($id)
{
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "delete from usuarios where id = '" . $id . "'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function showInfo($id)
{
    $page = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Informacion</title>
    </head>
    <body>
        <p>Nombre:' . getInfo($id, "Nombre") . '</p>
        <p>Usuario:' . getInfo($id, "Usuario") . '</p>
        <p>Contrasena:' . getInfo($id, "clave") . '</p>
        <p>Email:' . getInfo($id, "email") . '</p>
    </body>
    </html>
    ';
    return $page;
    //скорее всего придётся создавать генератор файла и кидать в него текст
    //добавить отлов ошибок в получении данных, для того, если юзер удалён на сервере и его удаляют в приложении, не возникло ошибки
}
function getInfo($id, $param)
{
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select " . $param . "from usuarios where id = '" . $id . "'";
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
    <style>
        img {
            height: 50px;
            width: 50px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
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
            echo '<tr>';
            $line = mysqli_fetch_assoc($list);
            echo '<td><a href="' . showInfo($line["id_usuario"]) . '" id="' . $line["id_usuario"] . '">' . $line[$i] . '</a></td>';
            //возможно придётся сделать с помощью формы и кнопок, перенаправляющих на нужную инфу
            echo '<td><img src="img/borrar.png" alt="borrar">test</td>';
            echo '<td><img src="img/editar.png" alt="editar"></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <form action="index.php" method="post">
        <input type="submit" value="Insertar nuevo Usuario" name="go_insert">
    </form>
</body>

</html>