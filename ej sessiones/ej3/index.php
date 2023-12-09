<?php
session_start();
if (!isset($_SESSION["number"]) || $_SESSION["number"] == "") {
    $_SESSION["number"] = 0.0;
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
    <form action="index2.php" method="post">
        <button type="submit" name="mice">-</button>
        <span><?php echo $_SESSION["number"] ?></span>
        <button type="submit" name="plus">+</button><br>
        <button type="submit" name="back">Poner a cero</button>
    </form>
</body>

</html>