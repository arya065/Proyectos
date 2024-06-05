<?php
require "../functions_clients.php";
session_name("client_session");
session_start();
if (isset($_POST["exit"])) {
    salir($_SESSION["api_session"]);
    session_destroy();
    header("Location: ../index.php");
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
    // print_r($alumnos);
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
                        if ($_POST["alumno"] == $value->cod_usu) {
                            echo "<option value='$value->cod_usu'selected>";
                        } else {
                            echo "<option value='$value->cod_usu'>";
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
            echo "<p>Notas de Alumno " . $_POST["alumno"] . "</p>";
            $notas = notasAlumno($_SESSION["api_session"], $_POST["alumno"]);
            $notasNoEval = notasNoEvalAlumno($_SESSION["api_session"], $_POST["alumno"]);
            // print_r($notas->notas);
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
                        echo "<td>" . $value->nota . "</td>";

                        echo "<td>";
                        echo '<button type="submit" name="edit" value="edit">Editar</button>';
                        echo '<button type="submit"name="del" value="del">Borrar</button>';
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <?php
                // exist NotasNoEval
                if (!isset($notasNoEval->notas) || $notasNoEval->notas == []) {
                    echo "<p>A " . $_POST["alumno"] . " no quedan asignaturas para calificar</p>";
                } else {
                    echo "<p>Asignaturas que a " . $_POST["alumno"] . " aun le quedan por calificar ";
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