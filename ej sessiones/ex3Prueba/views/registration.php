<?php
require "../function.php";
session_start();
/* 
REGISTRATION:
campos vacios
usuario no repetido
contrasena repetida correctamente
telefono es un numero de 9 digitos
email es correcto sintacticamente y no repetido
dni es correcto
*/
if (isset($_POST["send"])) {
    // vacio
    if ($_POST["nombre"] == "") {
        $err_nombre = true;
    }
    if ($_POST["clave"] == "") {
        $err_clave = true;
    }
    if ($_POST["claveRep"] == "") {
        $err_claveRep = true;
    }
    if ($_POST["dni"] == "") {
        $err_dni = true;
    }
    if ($_POST["mail"] == "") {
        $err_mail = true;
    }
    if ($_POST["tel"] == "") {
        $err_tel = true;
    }
    // repetidos
    // if (checkRepeat("usuarios", "usuario", $_POST["nombre"])) {
    //     $err_nombre = true;
    // }
    // if (checkRepeat("usuarios", "email", $_POST["mail"])) {
    //     $err_mail = true;
    // }
    if ($_POST["clave"] != $_POST["claveRep"]) {
        $err_claveRep = true;
    }
    //otros
    if (!is_numeric($_POST["tel"]) || (strlen($_POST["tel"]) != 9)) {
        $err_tel = true;
    }
    if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $err_mail =  true;
    }
    if (!LetraNIF($_POST["dni"])) {
        $err_dni = true;
    }
    $err_form = $err_nombre || $err_clave || $err_claveRep || $err_dni || $err_mail || $err_tel;
    // $err_form = true;
    if (!$err_form) {
        $_SESSION["username"] = $_POST["nombre"];
        header("Location: listado.php");
        return;
    }
}
function checkRepeat($table, $field, $value)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from $table where $field='$value'";
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
    <style>
        .red {
            color: red;
        }

        .red::after {
            content: "*";
        }

        .red::before {
            content: "*";
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <form action="registration.php" method="post">
        <p>
            <label for="nombre">Nombre de usuario:</label>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["send"])) echo $_POST["nombre"] ?>">
            <?php
            if (isset($err_nombre)) {
                echo '<span class="red">error</span>';
            }
            ?>
        </p>
        <p>
            <label for="clave">Contrasena:</label>
            <input type="password" name="clave" id="clave" value="<?php if (isset($_POST["send"])) echo $_POST["clave"] ?>">
            <?php
            if (isset($err_clave)) {
                echo '<span class="red">error</span>';
            }
            ?>
        </p>
        <p>
            <label for="claveRep">Repita la contrasena:</label>
            <input type="password" name="claveRep" id="claveRep">
            <?php
            if (isset($err_claveRep)) {
                echo '<span class="red">error</span>';
            }
            ?>
        </p>
        <p>
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" value="<?php if (isset($_POST["send"])) echo $_POST["dni"] ?>">
            <?php
            if (isset($err_dni)) {
                echo '<span class="red">error</span>';
            }
            ?>
        </p>
        <p>
            <label for="mail">Email:</label>
            <input type="text" name="mail" id="mail" value="<?php if (isset($_POST["send"])) echo $_POST["mail"] ?>">
            <?php
            if (isset($err_mail)) {
                echo '<span class="red">error</span>';
            }
            ?>
        </p>
        <p>
            <label for="tel">Telefono:</label>
            <input type="text" name="tel" id="tel" value="<?php if (isset($_POST["send"])) echo $_POST["tel"] ?>">
            <?php
            if (isset($err_tel)) {
                echo '<span class="red">error</span>';
            }
            ?>
        </p>
        <p>
            <button type="submit" formaction="../index.php" name="back">Volver</button>
            <button type="submit" name="send">Continuar</button>
        </p>
    </form>
</body>

</html>