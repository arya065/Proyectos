<?php
require "../src/funciones_ctes.php";

session_name("Examen_Final_DWESE_23_24");
session_start();

if (isset($_POST["exit"]) || timeout($_SESSION["last_active"]) || isset(logueado($_SESSION["api_session"])->error)) {
    salir($_SESSION["api_session"]);
    session_destroy();
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Final PHP</title>
    <style>
        .en_linea {
            display: inline
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25em;
            color: blue
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center
        }

        th {
            background-color: #CCC
        }
    </style>
</head>

<body>
    <h1>Examen Final PHP</h1>
    <div>
        Bienvenido <strong><?php echo $_SESSION["usuario"]; ?></strong> -
        <form class="en_linea" action="vista_normal.php" method="post">
            <button class="enlace" name="exit" type="submit">Salir</button>
        </form>
    </div>
    <h2>Su horario</h2>
    <h3>Horario del Profesor <?php echo $_SESSION["nombre"] ?></h3>
    <?php
    //prepare values for table
    $list = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:15-13:45", "13:15-14:45"];
    $res = horarioProfesor($_SESSION["api_session"], $_SESSION["id_usuario"]);
    ?>
    <table border="1px">
        <tr>
            <th></th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miercoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
        <?php
        foreach ($list as $key => $value) {
            if ($key + 1 == 4) {
                echo "<tr><td>$value</td><td colspan='5'>Recreo</td></tr>";
            }
            echo "<tr>";
            echo '<td>' . $value . '</td>';
            for ($i = 1; $i < 6; $i++) {
                echo "<td>";
                foreach ($res->horarioProfesor as $value2) {
                    if ($value2->hora == $key + 1 && $value2->dia == $i) {
                        echo "<p>" . $value2->nombre . "</p>";
                        echo "<p>(" . $value2->aula . ")</p>";
                    } else {
                        echo "<p></p>";
                    }
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>