<?php
if (isset($_POST["send"])) {
    show_timetable($_POST["seleccionar"]);
}
function getList()
{
    $listNames = [];
    @$fd = fopen("Horario/horarios.txt", "r");
    while (!feof($fd)) {
        $string = fgets($fd);
        $listNames[] = mi_explode_first($string, "\t");
    }
    return $listNames;
}
function mi_explode($string, $delimiter, $previous_pos)
{
    $result = [];
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == $delimiter) {
            $result[] = mi_substr($string, $previous_pos + 1, $i);
            $previous_pos = $i;
        }
    }
    return $result;
}
function mi_explode_first($string, $delimiter)
{
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] === $delimiter) {
            return mi_substr($string, 0, $i);
        }
    }
}
function mi_substr($string, $start, $end = null)
{
    if ($end == null) {
        $end = strlen($string);
    }
    $volver = "";
    for ($i = $start; $i < $end; $i++) {
        $volver = $volver . $string[$i];
    }
    return $volver;
}

function show_timetable($line)
{
    $pos = $line + 1;
    @$fd = fopen("Horario/horarios.txt", "r");
    for ($i = 0; $i < $pos; $i++) {
        $tmp = fgets($fd);
        if ($i == $pos - 1) {
            $line = $tmp;
        }
    }

    $line =  mi_explode($line, "\t", 0);
    $matrix = [];
    for ($i = 1; $i < count($line) - 2; $i += 3) {
        if (isset($matrix[$line[$i]][$line[$i + 1]])) {
            $matrix[$line[$i]][$line[$i + 1]] = $matrix[$line[$i]][$line[$i + 1]] . "/" . $line[$i + 2];
        }
        $matrix[$line[$i]][$line[$i + 1]] = $line[$i + 2];
    }
?>
    <table border="1">

        <?php
        for ($i = 1; $i < 8; $i++) {
            echo "<tr>";
            for ($j = 1; $j < 6; $j++) {
                if ($i == 4) {
                    echo "<td>recreo</td>";
                } elseif (isset($matrix[$j][$i])) {
                    echo "<td>";
                    echo $matrix[$j][$i];
                    echo "</td>";
                    // echo "values: ", $matrix[$j][$i], "<br>";
                } else {
                    echo "<td>&nbsp;</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
<?php
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - examen 1</title>
</head>

<body>
    <h1>Horario los profesores</h1>
    <p>Horario del Profesor:</p>
    <form action="exist.php" method="post" enctype="multipart/form-data">
        <?php
        $list_names = getList();
        ?>
        <select name="seleccionar" id="seleccionar">
            <?php
            for ($i = 0; $i < count($list_names); $i++) {

                echo '<option value="' . $i . '">' . $list_names[$i] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Ver Horario" name="send">
    </form>
</body>

</html>