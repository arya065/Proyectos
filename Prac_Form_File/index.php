<?php
// Doca
// https://educacionadistancia.juntadeandalucia.es/centros/malaga/pluginfile.php/385132/mod_resource/content/2/Enunciado_Formulario2.pdf
if (isset($_POST["send"])) {
    $error_foto = $_FILES["photo"]["name"] != "" && ($_FILES["photo"]["error"] || !getimagesize($_FILES["photo"]["tmp_name"]));
}
// function dniCorrect()
// {

//     También, controlaremos que el DNI introducido sea válido. Para ello vamos a suponer que un
// DNI válido va a ser una secuencia de ocho dígitos seguidos de una letra (Ejemplos: 11223344P,
// 12347898g, …..). Para comprobar que la letra del DNI es válida podemos usar la siguiente
// función PHP, a la cual se le pasa un número de DNI, y nos devuelve la letra mayúscula que le
// corresponde:
function LetraNIF($dni)
{
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
}

// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellena tu CV</title>
</head>

<body>
    <h1>Rellena tu CV</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
            <?php
            if (isset($_POST["send"]) && $_POST["nombre"] == "") {
                echo "Campo vacio";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario:</label> <br>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["send"]) && $_POST["usuario"] == "") {
                echo "Campo vacio";
            }
            ?>
        </p>
        <p>
            <label for="contrasena">Contrasena:</label> <br>
            <input type="password" name="contrasena" id="contrasena">
            <?php
            if (isset($_POST["send"]) && $_POST["contrasena"] == "") {
                echo "Campo vacio";
            }
            ?>
        </p>
        <p>
            <label for="dni">DNI:</label> <br>
            <input type="text" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php
            if (isset($_POST["send"]) && $_POST["dni"] == "") {
                echo "Campo vacio";
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
                echo "Campo vacio";
            }
            ?>
        </p>
        <p>
            <label for="photo">Incluir mi foto (Archivo de tipo imagen Max.500KB):</label>
            <input type="file" name="photo" value="photo" id="photo">
            <?php
            // if (isset($_FILES["photo"])) {
            //     echo '<input type="hidden" name="existing_photo" value="' . $_FILES["photo"]["name"] . '">';
            //     echo 'Archivo seleccionado: ' . $_FILES["photo"]["name"];
            // }
            ?>

            <?php
            // if (isset($_POST["send"]) && isset($_FILES["photo"]) && $_FILES["photo"]["error"] !== 0) {
            //     echo "Campo vacio";
            // }
            ?>
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

</html>