<!-- formulario con campo de texto que te diga si un caracter se repite o no, ej hola no se repite,
 pero si escribes hola hermano si se repite el carater h solo se puede usar trim() y strlength() -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
if (isset($_POST["send"]) && ($_POST["texto"] != "")) {
    if (ifRepeat(trim($_POST["texto"]), 0)) {
        echo "se repite";
    } else {
        echo "no se repite";
    }
}
function ifRepeat($text, $index)
{
    if ($index == strlen($text) - 1) {
        return false;
    }
    $letter = $text[$index];

    for ($i = $index + 1; $i < strlen($text); $i++) {
        if ($letter == $text[$i]) {
            return true;
        }
    }
    return ifRepeat($text, $index + 1);
}
?>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="texto">Introduce el texto</label>
        <input type="text" name="texto" id="texto" placeholder="Introduce el texto">
        <br>
        <input type="submit" value="send" name="send">
    </form>
</body>

</html>