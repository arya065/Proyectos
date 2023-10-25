<?php
function getList()
{
    $listNames = [];
    @$fd = fopen("Horario/horarios.txt", "r");
    while (!feof($fd)) {
        $string = fgets($fd);
        // $string = mi_explode
    }
}
function mi_explode($string, $delimiter)
{
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] === $delimiter) {
            return mi_substr($string, 0, $i);
        }
    }
}
function mi_substr($string, $start, $end)
{
    if ($end == null) {
        $end = strlen($string) - 1;
    }
    $volver = "";
    for ($i = $start; $i < $end; $i++) {
        $volver = $volver . $string[$i];
    }
    return $volver;
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
        <select name="seleccionar" id="seleccionar">

        </select>
        <input type="submit" value="Ver Horario">
    </form>
</body>

</html>