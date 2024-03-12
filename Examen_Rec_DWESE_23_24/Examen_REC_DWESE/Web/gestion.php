<?php
session_name("ExamenRec_SW_23_24");
session_start();
require "functions.php";
if ($_SESSION["act"] < time() - 5 * 60) {
    $response = json_decode(consumir_servicios_REST("/salir", "GET", ["api_session" => $_SESSION["api_session"]]));
    session_destroy();
    header("Location: index.php");
    exit;
} else {

    if (isset($_POST["exit"])) {
        $response = json_decode(consumir_servicios_REST("/salir", "GET", ["api_session" => $_SESSION["api_session"]]));
        session_destroy();
        header("Location: index.php");
        exit;
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

            th {
                background-color: darkgray;
            }

            td {
                text-align: center;
            }

            ul {
                list-style-type: decimal;
            }
        </style>
    </head>

    <body>
        <h1>Gestion de guardias</h1>
        <form action="gestion.php" method="post">
            <p>Bienvenido
                <?php echo $_SESSION["usuario"] ?> - <button type="submit" name="exit" value="exit">Salir</button>
            </p>
        </form>
        <p>Hoy es
            <?php
            $day = date_format(date_create($datetime = "now"), "N");
            if ($day == 1) {
                echo "Lunes";
            } else if ($day == 2) {
                echo "Martes";
            } else if ($day == 3) {
                echo "Miercoles";
            } else if ($day == 4) {
                echo "Jueves";
            } else if ($day == 5) {
                echo "Viernes";
            } else if ($day == 6) {
                echo "Sabado";
            } else if ($day == 7) {
                echo "Domingo";
            }
            ?>
        </p>
        <table border="1px">
            <tr>
                <th>Hora</th>
                <th>Profesor de guardia</th>
                <th>Informacion</th>
            </tr>
            <?php
            $tiempo = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:45-12:45", "12:45-13:45", "13:45-14:45"];
            for ($i = 0; $i < 6; $i++) {
                $tmp = "show$i";
                echo "<tr>";
                echo '<form action="gestion.php" method="post">';
                echo '<td>' . $tiempo[$i] . '</td>';
                echo '<td><ul>';

                $hora = $i + 1;
                $list = json_decode(consumir_servicios_REST("/usuariosGuardia/$day/$hora", "GET", ["api_session" => $_SESSION["api_session"]]));
                foreach ($list->usuario as $key => $value) {
                    echo "<li><button type='submit' name='$tmp' value='$value->id_usuario'>";
                    // print_r($value);
                    $nombre = explode(",", $value->nombre);
                    echo "$nombre[0],$value->usuario";
                    echo "</button></li>";
                }
                echo '</ul></td>';
                echo '</form>';
                //right
                if (isset($_POST[$tmp]) && $_POST[$tmp] != "") {
                    $info = json_decode(consumir_servicios_REST("/usuario/" . $_POST[$tmp], "GET", ["api_session" => $_SESSION["api_session"]]));
                    echo '<td>';
                    // print_r($info);
                    echo "<p>Nombre:" . $info->usuario->nombre . "</p>";
                    echo "<p>Usuario:" . $info->usuario->usuario . "</p>";
                    echo "<p>Contrasena:</p>";
                    echo "<p>Email:Email no disponible</p>";
                    echo '</td>';
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </body>

    </html>
    <?php
}
?>