<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="usuario_nuevo.php" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario">
        </p>
        <p>
            <label for="clave">Contrasena</label>
            <input type="password" name="clave" id="clave">
        </p>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </p>
        <p>
            <input type="submit" value="Continuar" name="insertar">
            <input type="submit" value="Volver" name="volver">
        </p>
    </form>
</body>
</html>