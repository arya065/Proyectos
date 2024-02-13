<?php
require("function.php");
session_start();
// session_destroy();
function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}
function exist($table)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from $table";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
function getListUsers()
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
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function getName($id)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where id_usuario=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    $line = mysqli_fetch_assoc($result);
    return $line["nombre"];
}
function getLessonsDayHour($id, $i, $j)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from horario_lectivo where usuario=$id and dia =$j and hora=$i";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function getGroupName($id)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from grupos where id_grupo=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }

    return mysqli_fetch_assoc($result)["nombre"];
}
function getAllGroups()
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from grupos";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }

    return $result;
}
function delGroup($id, $dia, $hora, $grupo)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "delete from horario_lectivo where usuario=$id, dia=$dia, hora=$hora, grupo=$grupo";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    th {
        background-color: lightgrey;
    }

    td {
        text-align: center;
    }
</style>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php

    if (!exist("usuarios")) {
        echo '<p>En estos momentos no tenemos ningun alumno registrado en la BD</p>';
    } else {
        echo '<form action="index.php" method="post">';
        echo "Horario del Profesor:";
        echo '<select name="profesor" id="profesor">';
        $list = getListUsers();
        while ($line = mysqli_fetch_assoc($list)) {
            echo '<option value="' . $line["id_usuario"] . '"';
            if ((isset($_POST["username"]) && ($_POST["profesor"] == $line["id_usuario"])) || (isset($_SESSION["username"]) && ($_SESSION["username"]) != "") && $_SESSION["id"] == $line["id_usuario"]) {
                echo "selected";
            }
            echo '>' . $line["nombre"] . '</option>';
        }
        echo '</select>';
        echo '<button type ="submit" value="ver" name ="username">Ver Horario</button>';
        echo '</form>';
    }

    //ver horario
    if (isset($_POST["username"])) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["id"] = $_POST["profesor"];
    }
    if (isset($_POST["username"]) || (isset($_SESSION["username"]))) {
        if (!isset($_SESSION["username"])) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["id"] = $_POST["profesor"];
        }
        if (isset($_SESSION["username"])) {
            $_POST["username"] = $_SESSION["username"];
            $_POST["profesor"] = $_SESSION["id"];
        }
        echo '<form action="index.php" method="post">';
        echo '<h3>Horario del Profesor:' . getName($_POST["profesor"]) . '</h3>';
        echo '<table border="1">';
        echo '<tr>';
        echo '<th> </th>';
        echo '<th>Lunes</th>';
        echo '<th>Martes</th>';
        echo '<th>Miercoles</th>';
        echo '<th>Jueves</th>';
        echo '<th>Viernes</th>';
        echo '</tr>';
        for ($i = 0; $i < 7; $i++) {
            echo '<tr>';
            if ($i == 0) {
                echo '<th>8:15-9:15</th>';
            }
            if ($i == 1) {
                echo '<th>9:15-10:15</th>';
            }
            if ($i == 2) {
                echo '<th>10:15-11:15</th>';
            }
            if ($i == 3) {
                echo '<th>11:15-11:45</th>';
                echo '<td colspan ="5">RECREO</td>';
            }
            if ($i == 4) {
                echo '<th>11:45-12:45</th>';
            }
            if ($i == 5) {
                echo '<th>12:45-13:45</th>';
            }
            if ($i == 6) {
                echo '<th>13:45-14:45</th>';
            }
            if ($i != 3) {
                for ($j = 0; $j < 5; $j++) {
                    echo '<td>';
                    $listLessons = getLessonsDayHour($_SESSION["id"], $i + 1, $j + 1);
                    echo '<p>';
                    while ($line = mysqli_fetch_assoc($listLessons)) {
                        echo getGroupName($line["grupo"]);
                        if (mysqli_num_rows($listLessons) > 1) {
                            echo  "/";
                        }
                    }
                    echo '</p>';
                    echo '<button type ="submit" value="' . $i, $j . '" name ="edit">Editar</button>';
                    echo '</td>';
                }
            }
            echo '</tr>';
        }

        echo '</table>';
        echo '</form>';
    }

    //editar
    if (isset($_POST["edit"]) || (isset($_SESSION["edit"]))) {
        if (!isset($_SESSION["edit"])) {
            $_SESSION["edit"] = $_POST["edit"];
        }
        if (isset($_SESSION["edit"])) {
            $_POST["edit"] = $_SESSION["edit"];
        }
        $hora = $_POST["edit"][0] + 1;
        $hour = $hora;
        if ($hora == 1) {
            $hora = "1 hora 8:15-9:15";
        } else if ($hora == 2) {
            $hora = "2 hora 9:15-10:15";
        } else if ($hora == 3) {
            $hora = "3 hora 10:15-11:15";
        } else if ($hora == 4) {
            $hora = "4 hora 11:15-11:45";
        } else if ($hora == 5) {
            $hora = "5 hora 11:45-12:45";
        } else if ($hora == 6) {
            $hora = "6 hora 112:45-13:45";
        } else if ($hora == 7) {
            $hora = "7 hora 13:45-14:45";
        }
        $dia = $_POST["edit"][1] + 1;
        $day = $dia;
        if ($dia == 1) {
            $dia = "Lunes";
        } else if ($dia == 2) {
            $dia = "Martes";
        } else if ($dia == 3) {
            $dia = "Miercoles";
        } else if ($dia == 4) {
            $dia = "Jueves";
        } else if ($dia == 5) {
            $dia = "Viernes";
        }
        echo '<h3>Editando la ' . $hora . '  del ' . $dia . ' dia</h3>';
        echo '<p><form action="index.php" method="post">';
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Grupo</th>';
        echo '<th>Accion</th>';
        $listLessons = getLessonsDayHour($_SESSION["id"], $_POST["edit"][0] + 1, $_POST["edit"][1] + 1);
        while ($line = mysqli_fetch_assoc($listLessons)) {
            echo '</tr>';
            echo '<td>';
            echo getGroupName($line["grupo"]);
            echo '</td>';
            echo '<td>';
            echo '<button type ="submit" value="' . $line["grupo"] . '" name ="del">Quitar</button>';
            echo '</td>';
            echo '<tr>';
        }
        echo '</tr>';
        echo '</table>';
        $groups = getAllGroups();
        echo '<select name="add_group" id="add_group">';
        while ($line = mysqli_fetch_assoc($groups)) {
            echo '<option value="' . $line["id_grupo"] . '">' . $line["nombre"] . '</option>';
        }
        echo '</select>';
        echo '<button type ="submit" value="' . $_SESSION["id"] . '" name ="add">Anadir</button>';
        echo '</form></p>';
        if (isset($_POST["del"])) {
            delGroup($_SESSION["id"], $day, $hour, $_POST["del"]);
        } else {
            unset($_SESSION["edit"]);
        }
        if (isset($_POST["add"])) {
        }
    }
    // session_destroy();
    // unset($_SESSION["username"]);

    ?>

</body>

</html>