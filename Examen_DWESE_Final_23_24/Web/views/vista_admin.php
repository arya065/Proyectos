<?php
require "../src/funciones_ctes.php";

session_name("Examen_Final_DWESE_23_24");
session_start();

if (isset($_POST["exit"]) || timeout($_SESSION["last_active"]) || isset(logueado($_SESSION["api_session"])->error)) {
    salir($_SESSION["api_session"]);
    session_destroy();
    header("Location: ../index.php");
}

if (isset($_POST["del"])) {
    echo "delete method";
    $valuesDel = json_decode($_POST["del"]);
    print_r($valuesDel);
    // borrarProfesor($_SESSION["api_session"],);
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
    <h2>Horario de los grupos</h2>
    <?php
    $grupos = grupos($_SESSION["api_session"]);

    ?>
    <form action="vista_admin.php" method="post">
        <label for="grupo">Elija el grupo:</label>
        <select name="grupo" id="grupo">
            <?php
            foreach ($grupos->grupos as $key => $value) {
                if ((isset($_POST["ver"]) && $_POST["grupo"] == $value->id_grupo) || (isset($_SESSION["ver"]) && $_SESSION["ver"] == $value->id_grupo)) {
                    echo '<option value="' . $value->id_grupo . '" selected>';
                    echo $value->nombre;
                    echo '</option>';
                    $group_name = $value->nombre;
                    if (isset($_POST["grupo"])) {
                        $_SESSION["ver"] = $_POST["grupo"];
                    }
                } else {
                    echo '<option value="' . $value->id_grupo . '">';
                    echo $value->nombre;
                    echo '</option>';
                }
            }
            ?>
        </select>
        <button type="submit" name="ver" value="ver">Ver Horario</button>
    </form>

    <?php
    if (isset($_POST["ver"]) || isset($_SESSION["ver"])) {
        $_POST["grupo"] = $_SESSION["ver"];
        echo "<h3>Horario del Grupo $group_name</h3>";
        //prepare values for table
        $list = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:15-13:45", "13:15-14:45"];
        $resGrupo = horarioGrupo($_SESSION["api_session"], $_POST["grupo"]);
        // print_r($resGrupo);
        ?>
        <form action="vista_admin.php" method="post">
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
                        $info = [];
                        $users_id = [];
                        foreach ($resGrupo->horarioGrupo as $value2) {
                            if ($value2->hora == $key + 1 && $value2->dia == $i) {
                                echo "<p>" . $value2->usuario . "(" . $value2->aula . ")</p>";
                                $info[] = $value2->usuario . "(" . $value2->aula . ")";
                                $users_id[] = $value2->id;
                            } else {
                                echo "<p></p>";
                            }
                        }
                        echo "<p><button type='submit' name='edit' value='" . json_encode(array("day" => $i, "hour" => $key + 1, "info" => $info, "users_id" => $users_id)) . "'>Editar</button></p>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
        <?php
    }
    if (isset($_POST["edit"]) || isset($_SESSION["edit"])) {
        if (isset($_SESSION["edit"])) {
            $_POST["edit"] = $_SESSION["edit"];
        }
        $_SESSION["edit"] = $_POST["edit"];
        $day = json_decode($_POST["edit"])->day;
        $hour = json_decode($_POST["edit"])->hour;
        $info = json_decode($_POST["edit"])->info;
        $users_id = json_decode($_POST["edit"])->users_id;
        // print_r($users_id);
        echo "<h3>Editando la $hour Hora (" . $list[$hour - 1] . ") del dia $day</h3>";
        ?>
        <form action="vista_admin.php" method="post">
            <table>
                <tr>
                    <th>Profesor (Aula)</th>
                    <th>Accion</th>
                </tr>
                <?php
                foreach ($info as $key => $value) {
                    echo "<tr>";
                    echo "<td>";
                    print_r($value);
                    echo "</td>";
                    echo "<td>";
                    echo '<button type="submit" name="del" value="' . json_encode(array("id" => $users_id[$key], "dia" => $day, "hora" => $hour)) . '">Quitar</button>';
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>

        <?php
    }
    ?>
</body>

</html>