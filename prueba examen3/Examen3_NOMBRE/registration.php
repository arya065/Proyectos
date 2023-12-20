<?php
if (isset($_POST["back"])) {
    header("Location: index.php");
    return;
}
if (isset($_POST["send"])){
    //check user and add func
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
    <form action="registration.php" method="post">
        <p><label for="usuario">Nombre de usuario</label><input type="text" name="usuario" id="usuario"></p>
        <p><label for="clave">Contrasena</label><input type="text" name="clave" id="clave"></p>
        <p><label for="repeat">Repeta la Contrasena</label><input type="text" name="repeat" id="repeat"></p>
        <p><label for="foto">Foto:</label><input type="file" name="foto" id="foto"></p>
        <p>
            <button type="submit" name="back">Volver</button>
            <button type="submit" name="send">Continuar</button>
        </p>
    </form>
</body>

</html>