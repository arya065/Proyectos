<?php
if (isset($_POST["send"]) && $_POST["texto"] != "") {
    $text = mi_explode($_POST["texto"], $_POST["selector"], 0);
}
function mi_explode($string, $delimiter, $previous_pos)
{
    $result = [];
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == $delimiter) {
            $result[] = mi_substr($string, $previous_pos, $i);
            $previous_pos = $i;
        }
    }
    if ($string[strlen($string) - 1] != $delimiter) {
        $result[] = mi_substr($string, $previous_pos);
    }
    return $result;
}
function mi_substr($string, $start, $end = null)
{
    if ($end === null) {
        $end = strlen($string);
    }
    $volver = "";
    for ($i = $start; $i < $end; $i++) {
        $volver = $volver . $string[$i];
    }
    return $volver;
}
function countVocals($text)
{
    $result = 0;
    $tmp = true;
    $letters = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
    foreach ($text as $value) {
        for ($i = 0; $i < strlen($value); $i++) {
            foreach ($letters as $letter) {
                if ($value[$i] == $letter) {
                    $tmp = false;
                }
            }
        }
        if (!$tmp) {
            $result++;
        }
        $tmp = true;
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2</title>
</head>

<body>
    <h1>Ejercicio2. Contar Palabras sin las vocales (a,e,i,o,u,A,E,I,O,U)</h1>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <label for="texto">Introduzca un Text</label>
        <input type="text" name="texto" id="texto" <? if (isset($_POST["send"])) echo  'value="' . $_POST["texto"] . '"' ?>>
        <?php
        if (isset($_POST["send"]) && $_POST["texto"] == "")
            echo "<span>*Campo vacio*</span>";
        ?>
        <br><br>
        <label for="selector">Elija el Separador</label>
        <select name="selector" id="selector">
            <option value=";">Punto y coma</option>
            <option value=",">Coma</option>
            <option value=".">Punto</option>
        </select>
        <input type="submit" value="Contar" name="send">
    </form>
    <?php
    if (isset($_POST["send"]) && $_POST["texto"] != "") {
        echo '<p>El texto: ' . $_POST["texto"] . ' con separador ' . $_POST["selector"] . ' contiene ' . countVocals($text) . ' palabras</p>';
    }
    ?>
</body>

</html>