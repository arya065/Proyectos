<?php
if (isset($_POST["send"])) {
    if (!errors($_POST, $_FILES)) {
        try {
            $conn = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conn, "utf8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        // show_info($conn, $id);
        try {
            $consulta = "insert into usuarios (usuario,clave,nombre,dni,sexo,foto) 
            values ('" . $_POST["usuario"] . "','" . $_POST["clave"] . "','" . $_POST["nombre"] . "','" . $_POST["dni"] . "','" . $_POST["sexo"] . "','    no_imagen.jpg')";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
        }
        echo '<style>a {color: black; text-decoration: none} a:visited {color: black}</style>';
        echo "Cambiado";
        echo '<p><button><a href="../index.php">OK</a></button></p>';
    }
    mysqli_close($conn);
    // header("location: index.php");
}


function user_err($post)
{
    if ($post["usuario"] != "") {
        if (strlen($post["usuario"]) > 30) {
            // echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
            return true;
        } else if (exist($post["usuario"], "usuario")) {
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
        } else if (exist($post["dni"], "dni")) {
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
function exist($value, $key)
{
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    // $line = mysqli_fetch_assoc($result);
    // if ($line[$key] == $value) {
    //     return true;
    // }
    // foreach ($line as $value2) {
    //     if ($value == $value2) {
    //         mysqli_close($conn);
    //         return true;
    //     }
    // }
    while ($line = mysqli_fetch_assoc($result)) {
        foreach ($line as $key2 => $value2) {
            if ($key == $key2) {
                if ($value == $value2) {
                    mysqli_close($conn);
                    return true;
                }
            }
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

        .red {
            color: red;
        }
    </style>
</head>

<body>
    <form action="add_user.php" method="post">

        <p><label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" value="<?php
        if (isset($_POST["send"])) {
            echo $_POST["usuario"];
        } ?>"></p>
        <?php
        if (isset($_POST["send"])) {
            if (strlen($_POST["usuario"]) > 30) {
                echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
            } else if (exist($_POST["usuario"], "usuario")) {
                echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
            } else if ($_POST["usuario"] == "") {
                echo "<span class ='red'>no puedes dejar campo vacio</span>";
            }
        }
        ?>
        <p><label for="clave">Clave:</label><input type="text" name="clave" id="clave" value="<?php
        if (isset($_POST["send"])) {
            echo $_POST["clave"];
        }
        ?>"></p>
        <?php
        if (isset($_POST["send"])) {
            if (strlen($_POST["clave"]) > 30) {
                echo "<span class ='red'>clave tiene que ser menor de 30 simbolos</span>";
            } else if ($_POST["clave"] == "") {
                echo "<span class ='red'>no puedes dejar campo vacio</span>";
            }
        }
        ?>
        <p><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" value="<?php
        if (isset($_POST["send"])) {
            echo $_POST["nombre"];
        }
        ?>"></p>
        <?php
        if (isset($_POST["send"])) {
            if (strlen($_POST["nombre"]) > 50) {
                echo "<span class ='red'>nombre tiene que ser menor de 50 simbolos</span>";
            } else if (exist($_POST["nombre"], "nombre")) {
                echo "<span class ='red'>no puedes repetir los nombres</span>";
            } else if ($_POST["nombre"] == "") {
                echo "<span class ='red'>no puedes dejar campo vacio</span>";
            }
        }
        ?>
        <p><label for="dni">DNI:</label><input type="text" name="dni" id="dni" value="<?php
        if (isset($_POST["send"])) {
            echo $_POST["dni"];
        }
        ?>"></p>
        <?php
        if (isset($_POST["send"])) {
            if (strlen($_POST["dni"]) > 10) {
                echo "<span class ='red'>dni tiene que ser menor de 10 simbolos</span>";
            } else if (!is_numeric(substr($_POST["dni"], 0, strlen($_POST["dni"]) - 1))) {
                echo "<span class ='red'>dni tiene que tener los numeros y una letra</span>";
            } else if ($_POST["dni"][strlen($_POST["dni"]) - 1] != LetraNIF(substr($_POST["dni"], 0, strlen($_POST["dni"]) - 1))) {
                echo "<span class ='red'>dni no correcto</span>";
            } else if (exist($_POST["dni"], "dni")) {
                echo "<span class ='red'>no puedes utilizar dni que ya esta utilizada</span>";
            } else if ($_POST["dni"] == "") {
                echo "<span class ='red'>no puedes dejar campo vacio</span>";
            }
        }
        ?>
        <p><label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option hidden>
                    <?php
                    if (isset($_POST["send"])) {
                        echo $_POST["sexo"];
                    }
                    ?>
                </option>
                <option value="hombre" selected>hombre</option>
                <option value="mujer">mujer</option>
            </select>
        </p>
        <p><label for="img">Imagen:</label>
            <img src="../img/no_imagen.jpg" alt="imagen usuario"><br>
            <!-- mysqli_insert_id -->

            <input type="file" name="img" id="img">
        </p>
        <input type="submit" value="Guardar" name="send">
        <button><a href="../index.php">Volver</a></button>
    </form>
</body>

</html>