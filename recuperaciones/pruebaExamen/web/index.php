<?php
require "functions.php";

session_name("web");

if (isset($_POST["entrar"])) {
    $response = login($_POST["usuario"], $_POST["clave"]);
    $_SESSION["api_session"] = $response->api_session;
    $_SESSION["usuario"] = $response->usuario[0]->nombre;
    print_r($response);
}
if (isset($_POST["salir"])) {
    $response = login($_POST["usuario"], $_POST["clave"]);
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
    if (isset($_SESSION["usuario"])) {
        echo '<form action="index.php" method="post">';
        echo '<p>Bienvenido $_SESSION["usuario"] -';
        echo '<button type="submit" name="salir" value="salir">Salir</button></p>';
        echo '</form>';
        echo '<p>Hoy es ' . date_format(date_create(), "l") . '</p>';
        $hours = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:15-13:45", "13:15-14:45"];
        ?>
        <table border="1px">
            <tr>
                <th>Hora</th>
                <th>Profesor de Guardia</th>
                <th>Informacion del Profesor con ID:</th>
            </tr>
            <?php
            foreach ($hours as $key => $value) {
                $guards = usuariosGuardia($_SESSION["api_session"], date_format(date_create(), "N"), $key + 1)->usuarios;
                $profs = [];
                foreach ($guards as $key => $value) {
                    print_r($value);
                    echo "<br>";
                    // print_r(usuario($_SESSION["api_session"],$value->id_horario)->usuario[0]->nombre);
                    // echo "<br>";
                    // echo "<br>";
                    $profs[]=usuario($_SESSION["api_session"],$value->id_horario)->usuario[0]->nombre;
                }
                print_r($profs);
                echo '<tr>';
                echo "<td>$value</td>";
                echo "<td><ul>";
                // echo
                echo"</ul></td>";
                echo "<td>info</td>";
                echo '</tr>';
            }
            echo "</table>";
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