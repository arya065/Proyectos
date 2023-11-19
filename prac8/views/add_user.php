<?php
if (isset($_POST["send"])) {
    errors($_POST, $_FILES);
}

function user_err($post)
{
    if ($post["usuario"] != "") {
        if (strlen($post["usuario"]) > 30) {
            // echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
            return true;
        } else if (exist($post["id"], $post["usuario"], "usuario")) {
            // echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
            return true;
        }
    }
    if ($post["usuario"] == "") {
        return true;
    }
    return false;
}
function pass_err($post)
{
    if ($post["clave"] != "") {
        if (strlen($post["clave"]) > 50) {
            // echo "<span class ='red'>clave tiene que ser menor de 50 sibmolos</span>";
            return true;
        }
    }
    if ($post["clave"] == "") {
        return true;
    }
    return false;
}
function name_err($post)
{
    if ($post["nombre"] != "") {
        if (strlen($post["nombre"]) > 50) {
            // echo "<span class ='red'>nombre tiene que ser menor de 50 sibmolos</span>";
            return true;
        }
    }
    if ($post["nombre"] == "") {
        return true;
    }
    return false;
}
function dni_err($post)
{
    if (($post["dni"]) != "") {
        if (strlen($post["dni"]) > 10) {
            // echo "<span class ='red'>dni tiene que ser menor de 10 simbolos</span>";
            return true;
        } else if (!is_numeric(substr($post["dni"], 0, strlen($post["dni"]) - 1))) {
            // echo "<span class ='red'>dni tiene que tener los numeros y una letra</span>";
            return true;
        } else if ($post["dni"][strlen($post["dni"]) - 1] != LetraNIF(substr($post["dni"], 0, strlen($post["dni"]) - 1))) {
            // echo "<span class ='red'>dni no correcto</span>";
            return true;
        } else if (exist($post["id"], $post["dni"], "dni")) {
            // echo "<span class ='red'>no puedes utilizar dni que ya esta utilizada</span>";
            return true;
        }
    }
    if ($post["dni"] == "") {
        return true;
    }
    return false;
}
function file_err($file)
{
    if (isset($file["img"])) {
        if ($file["img"]["size"] > 500 * 1024) {
            // echo "<span class ='red'>imagen tiene que ser menos de 500 KB</span>";
            return true;
        } else if (!getimagesize($file["img"]["tmp_name"])) {
            // echo "<span class ='red'>tienes que cargar la imagen</span>";
            return true;
        } else if ($file["img"]["error"]) {
            return true;
        }
    }
    return false;
}
function errors($post, $file)
{
    //username
    $user_err = user_err($post);
    //pass
    $pass_err = pass_err($post);
    //name
    $name_err = name_err($post);
    //dni
    $dni_err = dni_err($post);
    //file
    $file_err = file_err($file);

    $result = false;
    $result = $user_err || $pass_err || $name_err || $dni_err || $file_err;
    return $result;
}
function LetraNIF($dni)
{
    $valor = (int) ($dni / 23);
    $valor *= 23;
    $valor = $dni - $valor;
    $letras = "TRWAGMYFPDXBNJZSQVHLCKEO";
    $letraNif = substr($letras, $valor, 1);
    return $letraNif;
}
function exist($id, $value, $key)
{
    try {
        $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where id_usuario!=" . $id . "";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    $line = mysqli_fetch_assoc($result);
    // if ($line[$key] == $value) {
    //     return true;
    // }
    foreach ($line as $value2) {
        if ($value == $value2) {
            mysqli_close($conn);
            return true;
        }
    }
    mysqli_close($conn);
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
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
        <p><input type="submit" value="Guardar Cambios" name="send"><button><a href="../index.php"
                    id="back">Atras</a></button></p>
    </form>
</body>

</html>