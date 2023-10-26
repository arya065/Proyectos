<?php
if (isset($_POST["send"]) && correctFile($_FILES["fichero"]) && correcDesp($_POST["desp"]) && $_POST["desp"] != "" && $_POST["recibir"] != "") {
    $claves = makeShifr($_POST["recibir"], $_POST["desp"]);
}
function correctFile($file)
{
    if ($file["size"] > 1310720) {
        return false;
    }
    if ($file["type"] != "text/plain") {
        return false;
    }
    return true;
}
function correcDesp($text)
{
    for ($i = 1; $i < 27; $i++) {
        if ($text == $i) {
            return true;
        }
    }
    return false;
}
function makeShifr($text, $pos)
{
    $tmp = false;
    $result = "";
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'A'];
    for ($i = 0; $i < strlen($text); $i++) {
        foreach ($letters as $letter) {
            if (ord($letter) == ord($text[$i])) {
                $letter = change($letter, $pos);
                $result .= $letter;
                $tmp = true;
                break;
            }
        }
        if (!$tmp) {
            $result .= $text[$i];
        }
        $tmp =  false;
    }
    return $result;
}
function change($letter, $pos)
{
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'A'];
    for ($i = 0; $i < count($letters); $i++) {
        if (ord($letters[$i]) == ord($letter)) {
            if ($i + $pos > count($letters) - 1) {
                $diff = $pos + $i - count($letters) - 1;
                $letter = $letters[$diff];
            } else {
                $letter = $letters[$i + $pos];
            }
            return $letter;
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <label for="recibir">Introduzca un texto</label>
        <input type="text" name="recibir" id="recibir" <? if (isset($_POST["send"])) echo  'value="' . $_POST["recibir"] . '"' ?>>
        <br><br>
        <label for="desp">Desplazamiento</label>
        <input type="desp" name="desp" id="recibir" <? if (isset($_POST["send"])) echo  'value="' . $_POST["desp"] . '"' ?>>
        <br><br>
        <label for="fichero">Seleccione el archivo de claves (.txt y menor 1,25MB)</label>
        <input type="file" name="fichero" id="fichero">
        <br><br>
        <input type="submit" value="Codificar" name="send">
    </form>
    <?php
        if (isset($_POST["send"]) && correctFile($_FILES["fichero"]) && correcDesp($_POST["desp"]) && $_POST["desp"] != "" && $_POST["recibir"] != "") {
            echo "<h1>Respuesta</h1>";
            echo "<p>El texto introducido seria:</p>";
            echo $claves;
        }
    ?>
</body>

</html>