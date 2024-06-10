<?php
require "../functions_clients.php";
session_name("client_session");
session_start();

if (isset($_POST["exit"]) || timeout($_SESSION["last_active"]) || isset(logueado($_SESSION["api_session"])->error)) {
    salir($_SESSION["api_session"]);
    session_destroy();
    header("Location: ../index.php");
}
$_SESSION["last_active"] = time();
// del notas
if (isset($_POST["del"])) {
    $res = quitarNota($_SESSION["api_session"], $_SESSION["alumno"]->cod, $_POST["del"]);
    if (isset($res->resultado)) {
        $_SESSION["mensaje"] = "<p style='color: blue;'>!Asignatura descalificada con exito!</p>";
    } else {
        $_SESSION["mensaje"] = "<p style='color: blue;'>!Error de eliminacion!</p>";
    }
}
// cambiar notas
if (isset($_POST["edit"])) {
    $_SESSION["mensaje"] = "";
}
if (isset($_POST["atras"])) {
    $_SESSION["mensaje"] = "";
}
if (isset($_POST["cambiar"])) {
    if ($_POST["newnote"] > 10 || $_POST["newnote"] < 0) {
        $_SESSION["mensaje"] = "<p style='color: red;'>*No has introducido valor valido de nota*</p>";
    } else {
        $res = cambiarNota($_SESSION["api_session"], $_SESSION["alumno"]->cod, $_POST["cambiar"], $_POST["newnote"]);

        if (isset($res->resultado)) {
            $_SESSION["mensaje"] = "<p style='color: blue;'>!Nota cambiada con exito!</p>";
        } else {
            $_SESSION["mensaje"] = "<p style='color: red;'>!Error de cambiar la nota!</p>";
        }
    }
}
// anadir nota
if (isset($_POST["calificar"])) {
    $res = ponerNota($_SESSION["api_session"], $_SESSION["alumno"]->cod, $_POST["quedan"]);
    if (isset($res->resultado)) {
        $_SESSION["mensaje"] = "<p style='color: blue;'>!Asignatura calificada con un 0!</p>";
    } else {
        $_SESSION["mensaje"] = "<p style='color: blue;'>!Error de anadir!</p>";
    }
}

if (isset($_SESSION["mensaje"])) {
    $_POST["alumno"] = json_encode($_SESSION["alumno"]);
    $_POST["ver"] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Notas de alumnos</h1>
    <form action="prof.php" method="post">
        <p>Bienvenido <b><?php echo $_SESSION["usuario"] ?></b> <button type="submit" name="exit"
                value="exit">Salir</button>
        </p>
    </form>
    <?php
    $alumnos = alumnos($_SESSION["api_session"]);
    // print_r($alumnos->usuario);
    if (isset($alumnos->error)) {
        echo "<p>En este momento no tienes ningun alumno registrado en la BD</p>";
    } else {
        ?>
        <!-- Seleccionar alumno para mostrar notas -->
        <form action="prof.php" method="post">
            <p>
                Seleccione un alumno
                <select name="alumno" id="alumno">
                    <?php
                    foreach ($alumnos->usuario as $key => $value) {
                        if ($_POST["alumno"] == json_encode(["cod" => $value->cod_usu, "usuario" => $value->nombre])) {
                            echo "<option value='" . json_encode(["cod" => $value->cod_usu, "usuario" => $value->nombre]) . "' selected>";
                        } else {
                            echo "<option value='" . json_encode(["cod" => $value->cod_usu, "usuario" => $value->nombre]) . "'>";
                        }
                        echo $value->nombre;
                        echo "</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="ver" value="ver">Ver notas</button>
            </p>
        </form>
        <?php
        if (isset($_POST["ver"])) {//button ver notas
            $_SESSION["alumno"] = json_decode($_POST["alumno"]);
            $notas = notasAlumno($_SESSION["api_session"], $_SESSION["alumno"]->cod);
            $notasNoEval = notasNoEvalAlumno($_SESSION["api_session"], $_SESSION["alumno"]->cod);
            // print_r($notas->notas);
            echo "<p>Notas de Alumno <b>" . $_SESSION["alumno"]->usuario . "</b></p>";
            ?>
            <form action="prof.php" method="post">
                <!-- Mostrar notas alumno -->
                <table border="1px">
                    <tr>
                        <th>Asignatura</th>
                        <th>Nota</th>
                        <th>Accion</th>
                    </tr>
                    <?php
                    foreach ($notas->notas as $key => $value) {
                        echo "<tr>";
                        echo "<td>" . $value->denominacion . "</td>";
                        if (isset($_POST["edit"]) && $value->cod_asig == $_POST["edit"]) {
                            echo '<td><input type="number" name="newnote" id="newnote" value="' . $value->nota . '" placeholder="valor entre 0 y 10"></td>';
                            echo "<td>";
                            echo '<button type="submit" name="cambiar" value="' . $value->cod_asig . '">Cambiar</button>';
                            echo '<button type="submit" name="atras" value="' . $value->cod_asig . '">Atras</button>';
                            echo "</td>";
                        } else {
                            echo "<td>" . $value->nota . "</td>";
                            echo "<td>";
                            echo '<button type="submit" name="edit" value="' . $value->cod_asig . '">Editar</button>';
                            echo '<button type="submit" name="del" value="' . $value->cod_asig . '">Borrar</button>';
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
                <?php
                if (isset($_SESSION["mensaje"])) {
                    echo $_SESSION["mensaje"];
                    unset($_SESSION["mensaje"]);
                }
                // exist NotasNoEval
                if (!isset($notasNoEval->notas) || $notasNoEval->notas == []) {
                    echo "<p>A <b>" . $_SESSION["alumno"]->usuario . "</b> no quedan asignaturas para calificar</p>";
                } else {
                    echo "<p>Asignaturas que a <b>" . $_SESSION["alumno"]->usuario . "</b> aun le quedan por calificar ";
                    echo '<select name="quedan" id="quedan">';
                    foreach ($notasNoEval->notas as $key => $value) {
                        echo '<option value="' . $value->cod_asig . '">' . $value->denominacion . '</option>';
                    }
                    echo '</select> ';
                    echo '<button type="submit" name="calificar" value="calificar">Calificar</button>';
                    echo "</p>";
                }
                ?>
            </form>
            <?php
        }
    }
    ?>
</body>

</html>