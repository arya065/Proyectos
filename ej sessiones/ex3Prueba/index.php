<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
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
    <h1>Video Club</h1>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre de usuario:</label>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <label for="clave">Contrasena:</label>
            <input type="password" name="clave" id="clave">
        </p>
        <p>
            <button type="submit" name="entrar">Entrar</button>
            <button type="submit" formaction="views/registration.php" name="registrar">Registrarse</button>
        </p>
    </form>
</body>

</html>