<?php
if (isset($_POST["send"])) {
    controll_errors($_POST);
}
function controll_errors($post)
{

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
    <style>
        a {
            color: black;
            text-decoration: none;
        }

        a:visited {
            color: black;
        }
    </style>
</head>

<body>
    <form action="add_user.php" method="post">
        <h1>Agregar nuevo usuario</h1>
        <p><label for="nombre">Nombre</label></p>
        <input type="text" name="nombre" id="nombre" maxlength="50" required>
        <p><label for="usuario">Usuario</label></p>
        <input type="text" name="usuario" id="usuario" maxlength="30" required>
        <p><label for="clave">Contrasena</label></p>
        <input type="password" name="clave" id="clave" maxlength="50" required>
        <p><label for="dni">DNI</label></p>
        <input type="text" name="dni" id="dni" maxlength="10" required>
        <p><label for="hombre">Sexo</label></p>
        <p>
            <input type="radio" name="sexo" id="hombre" checked> <label for="hombre">Hombre</label>
            <input type="radio" name="sexo" id="mujer"> <label for="mujer">Mujer</label>
        </p>
        <p><label for="foto">Incluir mi foto(MAX. 500KB)</label> <input type="file" name="foto" id="foto"></p>
        <p><input type="submit" value="Guardar Cambios" name="send"><button><a href="index.php" id="back">Atras</a></button></p>
    </form>
</body>

</html>