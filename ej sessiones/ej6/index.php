<?php
session_start();
if (!isset($_SESSION["first"]) || $_SESSION["first"] == "") {
    $_SESSION["first"] = 100;
}
if (!isset($_SESSION["second"]) || $_SESSION["second"] == "") {
    $_SESSION["second"] = 10;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    #first {
        box-sizing: border-box;
        background-color: blue;
        height: 10px;
        /* width: <?php echo '' . $_SESSION["first"] . 'px' ?>; */
    }

    #second {
        background-color: orange;
        height: 10px;
        /* width: <?php echo $_SESSION["second"] ?>px; */
    }
</style>

<body>
    <form action="index2.php" method="get">
        <button type="submit" name="first">+</button>
        <?php
        echo '<div id="first" style="width: ' . $_SESSION["first"] . 'px"></div><br>';
        echo $_SESSION["first"];
        ?>
        <button type="submit" name="second">+</button>
        <div id="second"></div><br>
        <button type="submit" name="back">Poner a cero</button>
    </form>
</body>

</html>