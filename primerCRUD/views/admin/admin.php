<?php
require("../../function.php");
session_start();
if (!timeout() && stillExist($_SESSION["username"])) {
    function getAllUsers()
    {
        try {
            $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
            mysqli_set_charset($conn, "utf8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        try {
            $consulta = "select * from usuarios";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
        }

        return $result;
    }
    function getInfoUser($name)
    {
        try {
            $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
            mysqli_set_charset($conn, "utf8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        try {
            $consulta = "select * from usuarios where nombre='$name'";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
        }
        return mysqli_fetch_assoc($result);
    }
    function deleteUser($name)
    {
        try {
            $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
            mysqli_set_charset($conn, "utf8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        try {
            $consulta = "delete from usuarios where nombre='$name'";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
        }
    }
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: ../../index.php");
        return;
    }
    if (isset($_POST["addUser"])) {
        header("Location: create.php");
        return;
    }
    if (isset($_POST["del"])) {
        deleteUser($_POST["del"]);
        header("Location: admin.php");
        return;
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            table {
                border-collapse: collapse;
            }
        </style>
    </head>

    <body>
        <h1>Buenas ADMIN, <?php echo $_SESSION['username'] ?></h1>
        <h2>Listado de usuarios</h2>
        <form action="admin.php" method="post">
            <button type="submit" name="logout">Salir</button>
            <table border="1px">
                <tr>
                    <th>Nombre</th>
                    <th>Borrar</th>
                    <th>Editar</th>
                </tr>
                <?php
                $list = getAllUsers();
                while ($line = mysqli_fetch_assoc($list)) {
                    echo '<tr>';
                    echo '<td><button type="submit" name="show" value="' . $line["nombre"] . '">' . $line["nombre"] . '</button></td>';
                    echo '<td><button type="submit" value="' . $line["nombre"] . '" name="del"><img src="../../img/borrar.png" alt="del"></button></td>';
                    echo '<td><button type="submit"><img src="../../img/editar.png" alt="del"></button></td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <button type="submit" name="addUser">Insertar nuevo Usuario</button>
        </form>
        <?php
        if (isset($_POST["show"])) {
            $info = getInfoUser($_POST["show"]);
            echo '<h3>Listado de usuario ' . $_POST["show"] . '</h3>';
            echo '<p><b>Nombre:</b>' . $info["nombre"] . '</p>';
            echo '<p><b>Usuario:</b>' . $info["usuario"] . '</p>';
            echo '<p><b>Email:</b>' . $info["email"] . '</p>';
            echo '<p><b>Tipo:</b>' . $info["tipo"] . '</p>';
            echo '<form action="admin.php" method="post">';
            echo '<button type="submit">Volver</button>';
            echo '</form>';
        }
        ?>
    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    return;
}
?>