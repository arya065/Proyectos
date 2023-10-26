<?php
if (isset($_POST["generar"])) {
    $text = generateText();
    generateFile($text);
}
function generateText()
{
    $text = " Letra/Desplamiento;";
    $text .= PHP_EOL;
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'A'];
    for ($i = 1; $i < 27; $i++) {
        $text .= $i . ";";
    }
    $text .= PHP_EOL;

    for ($i = 0; $i < 25; $i++) {
        $diff = 25 - $i;
        for ($j = $i; $j < 25; $j++) {
            $text .= $letters[$j] . ";";
        }
        for ($k = 0; $k < $i; $k++) {
            $text .= $letters[$k] . ";";
        }
        $text .= $letters[$i] . PHP_EOL;
    }
    return $text;
}
function generateFile($text)
{
    @$fd = fopen("claves_cesar.txt", "w");
    $lines = mi_explode($text, PHP_EOL, 0);
    foreach ($lines as $line) {
        fwrite($fd, $line . PHP_EOL);
    }

    fclose($fd);
}
function writeText($text)
{
    echo "<h1>Respuesta</h1>";
    $lines = mi_explode($text, PHP_EOL, 0);
    echo "<textarea>";
    foreach ($lines as $line) {
        echo $line . PHP_EOL;
    }
    echo "</textarea>";
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>

<body>
    <h1>Ejercicio1. Generador de "claves_cesar.txt"</h1>
    <form action="ejercicio1.php" method="post" enctype="multipart/form-data">
        <input type="submit" value="Generar" name="generar">
    </form>
    <?php
    writeText($text);
    ?>
</body>

</html>