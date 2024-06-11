<?php
require "../funciones_web.php";
session_name("libreria");
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
    <h1>Libreria</h1>
    <form action="normal.php" method="post">
        <p>Bienvenido -<?php echo $_SESSION["usuario"] ?>- <button type="submit" name="salir"
                value="salir">Salir</button></p>
    </form>
    <h1>Lisado de usuarios</h1>
    <table>
        here is table
    </table>
</body>

</html>