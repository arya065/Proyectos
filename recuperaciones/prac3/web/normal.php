<?php
session_start();

if (isset ($_POST["exit"]) && $_POST["exit"] == "exit") {
    header("Location: ./index.php");
    return;
}

echo "<h1>Practica Rec 2</h1>";
echo '<form action="normal.php">';
echo '<p>Bienvenido ' . $_SESSION["usuario"];
echo '- <button type="submit" name="exit" value="exit">Salir</button>';
echo "</p>";
echo "</form>";
