<?php
session_name("Examen4_SW_23_24");
session_start();
require "../servicios_rest/src/funciones_servicios.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .red {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Notas de alumnos</h1>
    <?php
    if (isset($_SESSION["user"]) && $_SESSION["user"] != "") {
        echo '<form action="index.php" method="post">';
        echo '<p>Bienvenido, ' . $_SESSION["user"]->usuario->usuario . ' - <button type="submit" name="exit" value="exit">Salir</button></p>';
        echo '</form>';
        if (isset($_POST["exit"]) && $_POST["exit"] != "") {
            unset($_SESSION["user"]);
            header("Location: index.php");
        }
        echo '<h2>Notas del alumno' . $_SESSION["user"]->usuario->nombre . '</h2>';
        ?>
        <table border="1px">
            <tr>
                <th>Asignatura</th>
                <th>Nota</th>
            </tr>
            <?php
            $list = getNotes($_SESSION['user']->usuario->cod_usu, $_SESSION['user']->api_session);
            foreach ($list as $value) {
                foreach ($value as $key => $value2) {
                    echo '<tr>';
                    echo "<td>$value2->cod_asig</td>";
                    echo "<td>$value2->denominacion</td>";
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <?php
    } else {
        ?>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["login"]))
                    echo $_POST["usuario"] ?>">
                    <?php
                if (isset($_POST["login"]) && $_POST["usuario"] == "") {
                    echo '<span class="red">Error campo</span>';
                }
                ?>
            </p>
            <p>
                <label for="clave">Contrasena</label>
                <input type="pass" name="clave" id="clave">
                <?php
                if (isset($_POST["login"]) && $_POST["clave"] == "") {
                    echo '<span class="red">Error campo</span>';
                }
                ?>
            </p>
            <button type="submit" name="login" value="login">Login</button>
        </form>
        <?php
        if (isset($_POST["login"]) && $_POST["login"] != "" && $_POST["usuario"] != "" && $_POST["clave"] != "") {
            $log = login($_POST["usuario"], $_POST["clave"]);
            if (isset($log->usuario)) {
                $_SESSION["user"] = $log;
                if ($log->usuario->tipo == "alumno") {
                    header("Location: index.php");
                } else {
                    header("Location: admin/index.php");
                }
                return;
            } else {
                echo '<span class="red">No existe usuario</span>';
            }
        }
    }
    ?>
</body>

</html>