<?php
if (isset($_POST["count"]) && $_POST["texto"] != "") {
    $text = $_POST["texto"];
    
    echo "simoblos:",strlen($_POST["texto"]);
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
    <form action="ejercicio1.php" method="post" enctype="multipart/form-data">
        <label for="texto">Introduce texto:</label>
        <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
        <br>
        <input type="submit" value="Contar" name="count">
    </form>
</body>

</html>