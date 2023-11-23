<?php
require("../functions.php");

if (isset($_POST["send"])) {
    if (!errors($_POST, $_FILES)) {
        $id = $_POST["id"];
        foreach ($_POST as $key => $value) {
            if (($value != "") && ($key != "id" && $key != "send" && $key != "img")) {
                change($id, $value, $key);
            } else if ($value != "" && $key == "img") {
                createFile($id, $_FILES);
            }
        }
        echo '<style>a {color: black; text-decoration: none} a:visited {color: black}</style>';
        echo "Cambiado";
        echo '<p><button><a href="../index.php">OK</a></button></p>';
        // header("location: index.php");
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    // show_info($conn, $id);
    try {
        $consulta = "select * from usuarios where id_usuario = $id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    $line = mysqli_fetch_assoc($result);
    $id = $line["id_usuario"];
    $pass = $line["clave"];
    $name = $line["nombre"];
    $dni = $line["dni"];
    $sexo = $line["sexo"];
    $img = $line["foto"];
    mysqli_close($conn);
}
function getImage($id)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where id_usuario = $id";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    $line = mysqli_fetch_assoc($result);
    return $line["foto"];
}
function change($id, $value, $key)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }

    try {
        $consulta = "UPDATE usuarios SET " . $key . " = '" . $value . "' WHERE id_usuario='" . $id . "'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    mysqli_close($conn);
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
function createFile($id, $file)
{
    $type = end(explode('.', $file["img"]["name"]));
    $newName = "img_$id.$type";
    if (!file_exists("../img/" . $newName)) {
        move_uploaded_file($file["img"]["tmp_name"], "../img/" . $newName);
    }
    return $newName;
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
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where id_usuario !=" . $id . "";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <style>
        img {
            height: 100px;
            width: 100px;
        }

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
    <?php
    if ((isset($_GET["id"])) || (isset($_POST["send"])) && errors($_POST, $_FILES)) {
        ?>
        <form action="edit2.php" method="post" enctype="multipart/form-data">
            <p><label for="id">ID:</label><input type="text" name="id" id="id" value="<?php
            if (isset($_POST["send"]) && $_POST["id"] != "") {
                echo $_POST["id"];
            } else {
                echo $id;
            }
            ?>" readonly></p>
            <p><label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" value="<?php
            if (isset($_POST["send"])) {
                echo $_POST["usuario"];
            } else {
                echo $line["usuario"];
            } ?>"></p>
            <?php
            if (isset($_POST["send"])) {
                if (strlen($_POST["usuario"]) > 30) {
                    echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
                } else if (exist($_POST["id"], $_POST["usuario"], "usuario")) {
                    echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
                } else if ($_POST["usuario"] == "") {
                    echo "<span class ='red'>no puedes dejar campo vacio</span>";
                }
            }
            ?>
            <p><label for="clave">Clave:</label><input type="text" name="clave" id="clave" value="<?php
            if (isset($_POST["send"])) {
                echo $_POST["clave"];
            } else {
                echo $pass;
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
            } else {
                echo $name;
            }
            ?>"></p>
            <?php
            if (isset($_POST["send"])) {
                if (strlen($_POST["nombre"]) > 50) {
                    echo "<span class ='red'>nombre tiene que ser menor de 50 simbolos</span>";
                } else if (exist($_POST["id"], $_POST["nombre"], "nombre")) {
                    echo "<span class ='red'>no puedes repetir los nombres</span>";
                } else if ($_POST["nombre"] == "") {
                    echo "<span class ='red'>no puedes dejar campo vacio</span>";
                }
            }
            ?>
            <p><label for="dni">DNI:</label><input type="text" name="dni" id="dni" value="<?php
            if (isset($_POST["send"])) {
                echo $_POST["dni"];
            } else {
                echo $dni;
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
                } else if (exist($_POST["id"], $_POST["dni"], "dni")) {
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
                        } else {
                            echo $sexo;
                        }
                        ?>
                    </option>
                    <option value="hombre">hombre</option>
                    <option value="mujer">mujer</option>
                </select>
            </p>
            <p><label for="img">Imagen:</label>
                <img src="../img/<?php
                if (isset($_POST["send"])) {
                    echo getImage($_POST["id"]);
                } else {
                    echo $img;
                }
                ?>" alt="imagen usuario"><br>
                <input type="file" name="img" id="img">
            </p>
            <input type="submit" value="Guardar" name="send">
            <button><a href="../index.php">Volver</a></button>
        </form>
        <?php
    }
    ?>
</body>

</html>