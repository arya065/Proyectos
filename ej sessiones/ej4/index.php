<?php
session_start();
if (!isset($_SESSION["axis"]) || $_SESSION["axis"] == "") {
    $_SESSION["axis"] = 0;
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
        <button type="submit" name="left">&#x261C;</button>
        <button type="submit" name="right">&#x261E;</button><br>
        <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="600px" height="20px" viewbox="-300 0 600 20">
            <line x1="-300" y1="10" x2="300" y2="10" stroke="black" stroke-width="5" />
            <circle cx="<?php echo $_SESSION["axis"] ?>" cy="10" r="8" fill="red" />
        </svg>
        <br>
        <button type="submit" name="back">Volver a centro</button>
    </form>
</body>
</html>