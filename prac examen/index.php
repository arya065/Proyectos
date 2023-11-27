<?php
require("functions.php");
function emptyTable($tableName)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from $tableName";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return false;
    }
    return true;
}
function getValues($tableName)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from $tableName";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function getNotes($id)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from notas where cod_alu=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function getNameAsigna($id)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select denominacion from asignaturas where cod_asig=$id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    $line = mysqli_fetch_assoc($result);
    return $line["denominacion"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 2</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    table th {
        background-color: lightgrey;
    }
</style>

<body>
    <h1>Notas de alumnos</h1>
    <?php
    if (empty("notas")) {
        echo '<p>En este momento no tenemos ningun alumno registrado en la BD</p>';
    } else {
        $arr = getValues("alumnos");
        ?>
        <p>
        <form action="index.php" method="post">

            Seleccione un Alumno:
            <select name="nombre" id="nombre">
                <?php
                while ($line = mysqli_fetch_assoc($arr)) {
                    foreach ($line as $key => $value) {
                        if ($key == "nombre") {
                            if (isset($_POST["send"]) && $_POST["nombre"] == $line["cod_alu"]) {
                                echo '<option value="' . $line["cod_alu"] . '" selected>' . $value . '</option>';
                                $name = $line["nombre"];
                            } else {
                                echo '<option value="' . $line["cod_alu"] . '">' . $value . '</option>';
                            }
                        }
                    }
                }
                ?>
            </select>
            <input type="submit" value="Ver Notas" name="send">
        </form>
        </p>
        <?php
        if (isset($_POST["send"])) {
            $asigna = getValues("asignaturas");
            $notas = getNotes($_POST["nombre"]);
            echo '<h2>Notas de alumno ' . $name . '</h2>';
            echo '<table border="2px">';
            echo '<tr>';
            echo '<th>Asignatura</th>';
            echo '<th>Nota</th>';
            echo '<th>Accion</th>';
            echo '</tr>';
            if (mysqli_num_rows($notas) > 0) {
                // tiene asignaturas calificadas
                while ($line = mysqli_fetch_assoc($notas)) {
                    echo '<tr>';
                    foreach ($line as $key => $value) {
                        if ($key == "cod_asig") {
                            echo '<td>' . getNameAsigna($value) . '</td>';
                        }
                        if ($key == "nota") {
                            echo '<td>' . $value . '</td>';
                        }
                    }
                    echo '<td><a href="editar.php">Editar</a> - <a href="borrar.php">Borrar</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                // no tiene asignaturas calificadas
                echo '</table>';
                echo '<form action="index.php" method="post">';
                echo '<p>Asignaturas que a ' . $name . ' quedan por calificar  ';
                echo '<select name="asigna" id="asigna">';
                while ($line = mysqli_fetch_assoc($asigna)) {
                    foreach ($line as $key => $value) {
                        if ($key == "denominacion") {
                            echo '<option value="' . $line["cod_asig"] . '">' . $value . '</option>';
                        }
                    }
                }
                echo '<input type="submit" value="Calificar" name="qualify">';
                echo '</select></p>';

                echo '</form>';
            }
        }
        ?>

        <?php
    }
    ?>
</body>

</html>