<?php
// session_destroy();
require("function.php");
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
}
if (isset($_POST["entrar"]) && checkUser($_POST["nombre"], $_POST["clave"])) {
    $_SESSION["username"] = $_POST["nombre"];
    header("Location: views/listado.php");
    return;
}
function checkUser($user, $pass)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where usuario='$user' and clave='$pass'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
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