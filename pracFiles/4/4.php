<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter</title>
</head>
<?php
if (isset($_POST["send"]) && isset($_FILES["fichero"])) {
    if (!error_file($_FILES["fichero"])) {
        echo counter(file_get_contents($_FILES["fichero"]["tmp_name"]));
    }
}
function error_file($file)
{
    if ($file["size"] > 2621440) {
        return true;
    }
    if ($file["type"] != "text/plain") {
        return true;
    }
    return false;
}
function counter($file_content)
{
    $file_content = trim($file_content);
    return str_word_count($file_content);
}
?>

<body>
    <form action="4.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Selecciona fichero MAX.2,5 MB</label>
        <input type="file" name="fichero" id="fichero"><br>
        <input type="submit" value="send" name="send">
    </form>
</body>

</html>