<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
        echo '<p>Su nombre es: <b>' . $_SESSION["username"] . '</b></p>';
    } else {
        echo '<p>Su nombre es vacio</p>';
    }
    echo '<form action="index.php" method="post">';
    echo '<input type="submit" value="Volver a la primera pagina" name="back">';
    echo '</form>';

    if (isset($_POST["back"])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
    ?>
</body>

</html>