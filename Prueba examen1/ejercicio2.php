<?php
if (isset($_POST["send"])) {
    if (correctFile($_FILES["fichero"])) {
        @$fd = fopen("Ficheros/filename", "w");
        fwrite($fd, file_get_contents($_FILES["fichero"]["tmp_name"]));
        // move_uploaded_file($_FILES["fichero"]["tmp_name"],"Ficheros/filename");
        echo "Fichero subido";
        fclose($fd);
    } else {
        echo "Error de subir";
    }
}
function correctFile($file)
{
    if ($file["size"] > 1048576) {
        return false;
    }
    if ($file["type"] != "text/plain") {
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
    <title>Document</title>
</head>

<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Selecciona fichero de tipo .txt menor de 1MB</label>
        <input type="file" name="fichero" id="fichero">
        <br>
        <input type="submit" value="Enviar" name="send">
    </form>
</body>

</html>