<?php
if (ifexist()) {
    require "exist.php";
    return;
}
if (isset($_POST["send"]) && ifexist()) {
    require "exist.php";
    return;
}

function ifexist()
{
    // @$fd = fopen("Horario/horarios.txt", "r");
    if (file_exists("Horario/horarios.txt")) {
        return true;
    } else {
        return false;
    }
}
function createFile($file)
{
    move_uploaded_file($file["tmp_name"], "Horario/horarios.txt");
}
function correctFile($file)
{
    if ($file["type"] != "text/plain") {
        return false;
    }
    if ($file["size"] > 1048576) {
        return false;
    }
    return true;
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
    <h1>Ejercicio 4</h1>
    <h2>No se encuentra el archivo Horario/horarios.txt</h2>
    <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
        <label for="subir">Seleccione un archivo no superior a 1MB:</label>
        <input type="file" name="fichero" id="fichero"><br>
        <input type="submit" value="subir" name="send">
    </form>
</body>

</html>