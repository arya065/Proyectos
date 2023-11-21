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
        echo '<p><button><a href="../index.php">Volver</a></button></p>';
        return;
        // } else {
        //     echo '<style>a {color: black; text-decoration: none} a:visited {color: black}</style>';
        //     echo '<p><button><a href="index.php">OK</a></button></p>';
        //     // require "index.php";
        //     return;
    } else {
        require "edit.php";
    }
}

if (!function_exists('show_info')) {
    function show_info($conn, $id)
    {
        try {
            $consulta = "select * from usuarios where id_usuario = $id";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
        }
        $line = mysqli_fetch_assoc($result);

        // echo '<form action="edit.php" method="post">';
        // echo '<p><label for="id">ID:</label><input type="text" name="id" id="id" value="' . $line["id_usuario"] . '" readonly></p>';
        // echo '<p><label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" placeholder="' . $line["usuario"] . '"></p>';
        // if (isset($_POST["send"])) {
        //     // if ($_POST["usuario"] != "") {
        //     if (strlen($_POST["usuario"]) > 30) {
        //         echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
        //     } else if (exist($_POST["id"], $_POST["usuario"], "usuario")) {
        //         echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
        //     }
        //     // }
        // }
        // echo '<p><label for="clave">Clave:</label><input type="password" name="clave" id="clave" placeholder="' . $line["clave"] . '"></p>';
        // echo '<p><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" placeholder="' . $line["nombre"] . '"></p>';
        // echo '<p><label for="dni">DNI:</label><input type="text" name="dni" id="dni" placeholder="' . $line["dni"] . '"></p>';
        // echo '<p><label for="sexo">Sexo:</label>';
        // echo '<select name="sexo" id="sexo">';
        // echo '<option hidden>' . $line["sexo"] . '</option>';
        // echo '<option value="hombre">hombre</option>';
        // echo '<option value="mujer">mujer</option>';
        // echo '</select></p>';
        // echo '<p><label for="img">Imagen:</label><img src="img/' . $line["foto"] . '" alt="imagen usuario"><br><input type="file" name="img" id="img"></p>';
        // echo '<input type="submit" value="Guardar" name="send">';
        // echo '<button><a href="index.php">Volver</a></button>';
        // echo '</form>';
    }
}
// function showError()
// {
// }
if (!function_exists('show_info')) {
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
}
if (!function_exists('show_info')) {
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
}
if (!function_exists('show_info')) {
    function LetraNIF($dni)
    {
        $valor = (int) ($dni / 23);
        $valor *= 23;
        $valor = $dni - $valor;
        $letras = "TRWAGMYFPDXBNJZSQVHLCKEO";
        $letraNif = substr($letras, $valor, 1);
        return $letraNif;
    }
}
if (!function_exists('show_info')) {
    function exist($id, $value, $key)
    {
        try {
            $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
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
}

// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
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
        mysqli_close($conn);
    }
    ?>
    <form action="edit.php" method="post">
        <p><label for="id">ID:</label><input type="text" name="id" id="id" value="<?php echo $line["id_usuario"] ?>" readonly></p>
        <p><label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" placeholder="<?php echo $line["usuario"] ?>"></p>
        <?php
        if (isset($_POST["send"])) {
            // if ($_POST["usuario"] != "") {
            if (strlen($_POST["usuario"]) > 30) {
                echo "<span class ='red'>usuario tiene que ser menor de 30 simbolos</span>";
            } else if (exist($_POST["id"], $_POST["usuario"], "usuario")) {
                echo "<span class ='red'>no puedes repetir los nombres de usuario</span>";
            }
            // }
        }
        ?>
        <p><label for="clave">Clave:</label><input type="password" name="clave" id="clave" placeholder="<?php echo $line["clave"] ?>"></p>
        <p><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" placeholder="<?php echo $line["nombre"] ?>"></p>
        <p><label for="dni">DNI:</label><input type="text" name="dni" id="dni" placeholder="<?php echo $line["dni"] ?>"></p>
        <p><label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option hidden><?php echo $line["sexo"] ?></option>
                <option value="hombre">hombre</option>
                <option value="mujer">mujer</option>
            </select>
        </p>
        <p><label for="img">Imagen:</label><img src="img/<?php echo $line["foto"] ?>" alt="imagen usuario"><br><input type="file" name="img" id="img"></p>
        <input type="submit" value="Guardar" name="send">
        <button><a href="../index.php">Volver</a></button>
    </form>
</body>

</html>