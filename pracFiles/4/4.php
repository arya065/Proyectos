<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter</title>
</head>
<?php
function error_file($file = $_FILES["fichero"])
{
    if ($file["size"] > 2621440) {
        return false;
    }
    if ($file["type"] != "text/plain") {
        return false;
    }
}

?>

<body>
    <form action="4.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Selecciona fichero MAX.2,5 MB</label>
        <input type="file" name="fichero" id="fichero">
    </form>
</body>

</html>