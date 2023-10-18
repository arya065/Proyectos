<?php
if (isset($_POST["send"])) {
    // echo "<p> Correct " . LetraNIF(substr($_POST["dni"], 0, strlen($_POST["dni"]) - 1)) . "</p>";
    // echo "<p> NOW " . substr($_POST["dni"], strlen($_POST["dni"]) - 1) . "</p>";
    if (correctNie($_POST["dni"])) {
        $error_dni = ((LetraNIF(substr($_POST["dni"], 0, strlen($_POST["dni"]) - 1))) == (substr($_POST["dni"], strlen($_POST["dni"]) - 1)));
    }
    $error_form =  !isset($_FILES["send"]) && photoErr();
}
if (isset($_POST["send"]) && !$error_form) {
    require "respuesta.php";
    return;
}
function photoErr()
{
    $correct_type = ($_FILES["photo"]["type"] == "image/jpeg");
    // var_dump("type: ", $correct_type);
    $correct_size = ($_FILES["photo"]["size"] < 512000);
    // var_dump("size: ", $correct_size);

    if ($correct_type && $correct_size) {
        return false;
    } else {
        return true;
    }
}
function correctNie($string)
{
    $letters = "TRWAGMYFPDXBNJZSQVHLCKEO";
    $numbers = "12344567890";
    if (strlen($string) != 9) {
        return false;
    }
    $str_num = substr($string, 0, strlen($string) - 1);
    for ($i = 0; $i < strlen($str_num); $i++) {
        for ($j = 0; $j < strlen($letters); $j++) {
            if (substr($str_num, $i, 1) == $letters[$j]) {
                return false;
            }
        }
    }
    $letter = substr($string, strlen($string) - 1);
    for ($i = 0; $i < strlen($numbers); $i++) {
        if ($letter == substr($numbers, $i, 1)) {
            return false;
        }
    }
    return true;
}

function LetraNIF($dni)
{
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
    //comprueba los numeros con letras
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellena tu CV</title>
</head>
<style>
    span {
        color: red;
    }
</style>
<?php
// function forma()
// {
?>

<body>
    <h1>Rellena tu CV</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
            <?php
            if (isset($_POST["send"]) && $_POST["nombre"] == "") {
                echo "<span>Campo vacio</span>";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario:</label> <br>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["send"]) && $_POST["usuario"] == "") {
                echo "<span>Campo vacio</span>";
            }
            ?>
        </p>
        <p>
            <label for="contrasena">Contrasena:</label> <br>
            <input type="password" name="contrasena" id="contrasena">
            <?php
            if (isset($_POST["send"]) && $_POST["contrasena"] == "") {
                echo "<span>Campo vacio</span>";
            }
            ?>
        </p>
        <p>
            <label for="dni">DNI:</label> <br>
            <input type="text" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php
            if (isset($_POST["send"]) && $_POST["dni"] == "") {
                echo "<span>Campo vacio</span>";
            }elseif (isset($_POST["send"]) && !correctNie($_POST["dni"])) {
                echo "Debes rellenar el DNI con 8 digitos seguidos de una letra";
            }
            ?>
        </p>
        <p>
            <label for="hombre">Sexo:</label> <br>
            <input type="radio" name="sexo" value="hombre" id="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked" ?>>
            <label for="hombre">Hombre</label><br>
            <input type="radio" name="sexo" value="mujer" id="mujer" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked" ?>>
            <label for="mujer">Mujer</label><br>
            <?php
            if (isset($_POST["send"]) && !isset($_POST["sexo"])) {
                echo "<span>Campo vacio</span>";
            }
            ?>
        </p>
        <p>
            <label for="photo">Incluir mi foto (Archivo de tipo imagen Max.500KB):</label>
            <input type="file" name="photo" value="photo" id="photo">
        </p>

        <p>
            <input type="checkbox" name="sub" id="sub" value="sub" <?php if (isset($_POST["sub"])) echo "checked" ?>>
            <label for="sub">Subscribirme al boletin de Novedades</label>
        </p>
        <p>
            <input type="submit" value="Guardar Cambios" name="send">
            <input type="reset" value="Borrar los datos introducidos" name="clear">
        </p>
    </form>
</body>
<?php
// }
// if (!isset($_POST["send"])) {
//     forma();
// }
?>


</html>