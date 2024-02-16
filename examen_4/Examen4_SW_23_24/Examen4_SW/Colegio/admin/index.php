<?php
session_name("Examen4_SW_23_24");
session_start();

if (isset($_SESSION["user"]) && $_SESSION["user"] != "") {
    // print_r($_SESSION["user"]->usuario);
    echo "<h1>Administracion</h1>";
    echo '<form action="index.php" method="post">';
    echo '<p>Bienvenido, ' . $_SESSION["user"]->usuario->usuario . ' - <button type="submit" name="exit" value="exit">Salir</button></p>';
    echo '</form>';
    if (isset($_POST["exit"]) && $_POST["exit"] != "") {
        unset($_SESSION["user"]);
        header("Location: ../index.php");
    }
    echo '<h2>Notas del alumno' . $_SESSION["user"]->usuario->nombre . '</h2>';

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
</body>

</html>