<?php
if (isset($_POST["send"])) {
    if (!errors($_POST, $_FILES)) {
        $id = $_POST["id"];
        foreach ($_POST as $key => $value) {
            if (($value != "") && ($key != "id" && $key != "send")) {
                change($id, $value, $key);
            }
        }
        echo '<style>a {color: black; text-decoration: none} a:visited {color: black}</style>';
        echo "Cambiado";
        echo '<p><button><a href="index.php">OK</a></button></p>';
        // header("location: index.php");
    } else {
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
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
        $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
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
        $conn = mysqli_connect("localhost", "root", "qwer", "bd_cv");
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
function errors($post, $file)
{
    //username
    $user_err = false;
    if ($post["usuario"] != "") {
        if (strlen($post["usuario"]) > 30) {
            echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
            $user_err = true;
        } else if (exist($post["id"], $post["usuario"], "usuario")) {
            echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
            $user_err = true;
        }
    }
    //pass
    $pass_err = false;
    if ($post["clave"] != "") {
        if (strlen($post["clave"]) > 50) {
            echo "<span class ='red'>clave tiene que ser menor de 50 sibmolos</span>";
            $pass_err = true;
        }
    }
    //name
    $name_err = false;
    if ($post["nombre"] != "") {
        if (strlen($post["nombre"]) > 50) {
            echo "<span class ='red'>nombre tiene que ser menor de 50 sibmolos</span>";
            $name_err = true;
        }
    }
    //dni
    $dni_err = false;
    if (($post["dni"]) != "") {
        if (strlen($post["dni"]) > 10) {
            echo "<span class ='red'>dni tiene que ser menor de 10 simbolos</span>";
            $dni_err = true;
        } else if (!is_numeric(substr($post["dni"], 0, strlen($post["dni"]) - 1))) {
            echo "<span class ='red'>dni tiene que tener los numeros y una letra</span>";
            $dni_err = true;
        } else if ($post["dni"][strlen($post["dni"]) - 1] != LetraNIF(substr($post["dni"], 0, strlen($post["dni"]) - 1))) {
            echo "<span class ='red'>dni no correcto</span>";
            $dni_err = true;
        } else if (exist($post["id"], $post["dni"], "dni")) {
            echo "<span class ='red'>no puedes utilizar dni que ya esta utilizada</span>";
            $dni_err = true;
        }
    }
    //file
    $file_err = false;
    if (isset($file["img"])) {
        if ($file["img"]["size"] > 500 * 1024) {
            echo "<span class ='red'>imagen tiene que ser menos de 500 KB</span>";
            $file_err = true;
        } else if (!getimagesize($file["img"]["tmp_name"])) {
            echo "<span class ='red'>tienes que cargar la imagen</span>";
            $file_err = true;
        } else if ($file["img"]["error"]) {
            $file_err = true;
        }
    }

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
        $consulta = "select * from usuarios";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    $line = mysqli_fetch_assoc($result);
    foreach ($line as $value2) {
        if ($value == $value2) {
            return true;
        }
    }
    // if ($line[$key] == $value) {
    //     mysqli_close($conn);
    //     return true;
    // }
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
    if ((isset($_GET["id"])) || (isset($_POST["send"]) && errors($_POST, $_FILES))) {
        ?>
        <form action="edit2.php" method="post">
            <p><label for="id">ID:</label><input type="text" name="id" id="id" value="<?php
            if (isset($_POST["send"]) && $_POST["id"] != "") {
                echo $_POST["id"];
            } else {
                echo $id;
            }
            ?>" readonly></p>
            <p><label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" value="<?php
            if (isset($_POST["send"]) && $_POST["usuario"] != "") {
                echo $_POST["usuario"];
            } else {
                echo $line["usuario"];
            } ?>"></p>
            <?php
            // if (isset($_POST["send"])) {
            //     // if ($_POST["usuario"] != "") {
            //     if (strlen($_POST["usuario"]) > 30) {
            //         echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
            //     } else if (exist($_POST["id"], $_POST["usuario"], "usuario")) {
            //         echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
            //     }
            //     // }
            // }
            ?>
            <p><label for="clave">Clave:</label><input type="text" name="clave" id="clave" value="<?php
            if (isset($_POST["send"]) && $_POST["clave"] != "") {
                echo $_POST["clave"];
            } else {
                echo $pass;
            }
            ?>"></p>
            <p><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" value="<?php
            if (isset($_POST["send"])) {
                echo $_POST["nombre"];
            } else {
                echo $name;
            }
            ?>"></p>
            <p><label for="dni">DNI:</label><input type="text" name="dni" id="dni" value="<?php
            if (isset($_POST["send"])) {
                echo $_POST["dni"];
            } else {
                echo $dni;
            }
            ?>"></p>
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
                <img src="img/
                <?php
                if (isset($_POST["send"])) {
                    echo getImage($_POST["id"]);
                } else {
                    echo $img;
                }
                ?>" alt="imagen usuario"><br>
                <input type="file" name="img" id="img">
            </p>
            <input type="submit" value="Guardar" name="send">
            <button><a href="index.php">Volver</a></button>
        </form>
        <?php
    }
    ?>
</body>

</html>