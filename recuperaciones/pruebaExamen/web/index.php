<?php
require "functions.php";

session_name("web");
session_start();

if (isset($_SESSION["last_activity"])) {
    if (timeout($_SESSION["last_activity"])) {
        $response = salir($_SESSION["api_session"]);
        session_destroy();
        header("Location: index.php");
    } else {
        $_SESSION["last_activity"] = time();
    }
}

if (isset($_POST["entrar"])) {
    $response = login($_POST["usuario"], $_POST["clave"]);
    $_SESSION["api_session"] = $response->api_session;
    $_SESSION["usuario"] = $response->usuario[0]->nombre;
    $_SESSION["last_activity"] = time();
}
if (isset($_POST["salir"])) {
    $response = salir($_SESSION["api_session"]);
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th {
            background-color: lightgrey;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Gestion de Guardias</h1>
    <?php
    if (isset($_SESSION["usuario"]) && !isset(logueado($_SESSION["api_session"])->error)) {
        echo '<form action="index.php" method="post">';
        echo '<p>Bienvenido' . $_SESSION["usuario"] . '-';
        echo '<button type="submit" name="salir" value="salir">Salir</button></p>';
        echo '</form>';
        echo '<p>Hoy es ' . date_format(date_create(), "l") . '</p>';
        $hours = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:15-13:45", "13:15-14:45"];
        ?>
        <form action="index.php" method="post">
            <table border="1px">
                <tr>
                    <th>Hora</th>
                    <th>Profesor de Guardia</th>
                    <th>Informacion del Profesor con ID:</th>
                </tr>
                <?php
                foreach ($hours as $key => $value) {
                    if ($key != 3) {
                        $guards = usuariosGuardia($_SESSION["api_session"], date_format(date_create(), "N"), $key + 1)->usuarios;
                        echo '<tr>';
                        echo "<td>$value</td>";
                        echo "<td><ol>";
                        foreach ($guards as $value2) {
                            $name = usuario($_SESSION["api_session"], $value2->usuario)->usuario[0]->nombre;
                            echo "<li><button type='submit' name='showUser' value='" . $value2->usuario . "'>" . $name . "</button></li>";
                        }
                        echo "</ol></td>";
                        echo "<td>";
                        if (isset($_POST["showUser"]) && $key == 0) {
                            $curUser = usuario($_SESSION["api_session"], $_POST["showUser"])->usuario[0];
                            echo "<p>Nombre:" . $curUser->nombre . "</p>";
                            echo "<p>Usuario:" . $curUser->usuario . "</p>";
                            echo "<p>Contrasena:" . $curUser->clave . "</p>";
                            echo "<p>Email:";
                            if ($curUser->email == "") {
                                echo "Email no disponible";
                            }
                            echo "</p>";
                        }
                        echo "</td>";
                        echo '</tr>';

                    }
                }
                echo "</table>";
                echo '</form>';
    } else {
        ?>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <p>Usuario:</p>
                        <input type="text" name="usuario" id="usuario">
                    </div>
                    <div>
                        <p>Contrasena:</p>
                        <input type="text" name="clave" id="clave">
                    </div>
                    <button type="submit" value="entrar" name="entrar">Entrar</button>
                </form>
                <?php
    }
    ?>
</body>

</html>