<!-- mysqli_insert_id -->
<?php
if (isset($_GET["id"]) && $_GET["action"] == "delete") {
    delete_user($_GET["id"], getInfo($_GET["id"])["foto"]);
}
function delete_user($id, $img)
{
    try {
        $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "delete from usuarios where id_usuario=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    // unlink("img/" . $img . "");
}
function getInfo($id)
{
    try {
        $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
        mysqli_set_charset($conn, "utf8");
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
    $line = mysqli_fetch_assoc($result);
    return $line;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 8</title>
    <style>
        table {
            border-collapse: collapse;
        }

        img {
            height: 50px;
            width: 50px;
        }

        a:visited {
            color: blue;
        }
    </style>
</head>

<body>
    <h1>Practica 8</h1>
    <h3>Listado de los usuarios</h3>
    <table border="2">
        <form action="index.php" method="post">

            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th><a href="add_user.php">Usuario+</a></th><!--при нажатии открывает форму с добавлением пользователя-->
            </tr>
            <?php
            try {
                $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
                mysqli_set_charset($conn, "utf8");
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
            $num = mysqli_num_rows($result);
            for ($i = 0; $i < $num; $i++) {
                $line = mysqli_fetch_assoc($result);
                echo '<tr>';
                echo '<td>' . $line["id_usuario"] . '</td>';
                echo '<td><img src = "img/' . $line["foto"] . '"alt="Foto usuario"></td>';
                echo '<td><a href="show_info.php?id=' . $line["id_usuario"] . '">' . $line["nombre"] . '</a></td>';
                echo '<td><a href="index.php?id=' . $line["id_usuario"] . '&action=delete">Borrar</a> - <a href="edit.php?id=' . $line["id_usuario"] . '">Editar</a></td>';
                echo '</tr>';
            }
            ?>
        </form>
    </table>

</body>

</html>