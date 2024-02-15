<?php
require "./function.php";
require "../conf.php";
session_start();
if (isset($_SESSION["del"])) {
    echo $_SESSION["del"];
    echo "<br>";
    unset($_SESSION["del"]);
}
// if (isset($_SESSION["create"])) {
//     unset($_SESSION["create"]);
// }
function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos)) {
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    }

    // Добавим следующую строку для вывода дополнительной информации
    curl_setopt($llamada, CURLOPT_VERBOSE, true);

    $respuesta = curl_exec($llamada);

    // Добавим следующие строки для вывода ошибок, если они есть
    if ($respuesta === false) {
        echo 'cURL error: ' . curl_error($llamada);
    }

    curl_close($llamada);
    return $respuesta;
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
    </style>
</head>

<body>
    <h1>CRUD</h1>
    <h2>login</h2>
    <form action="index.php" method="post">
        <p>
            <label for="user">Usuario:</label>
            <input type="text" name="user" id="user" value="<?php if (isset($_POST["login"]))
                echo $_POST["user"] ?>">
                <?php
            if (isset($_POST["login"]) && $_POST["user"] == "") {
                echo '<span class="red">error campo</span>';
            }
            ?>
        </p>
        <p>
            <label for="pass">Clave:</label>
            <input type="text" name="pass" id="pass">
            <?php
            if (isset($_POST["login"]) && $_POST["usuario"] == "") {
                echo '<span class="red">error campo</span>';
            }
            ?>
        </p>
        <button type="submit" name="login" value="login">Login</button>
    </form>
    <?php
    if (isset($_POST['login']) && login($_POST["user"], $_POST["pass"]) > 0) {
        header("Location: login.php?id=" . login($_POST["user"], $_POST["pass"]));
    }
    ?>
    <h2>create</h2>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["create"]))
                echo $_POST["nombre"] ?>">
                <?php
            // echo "<hr>";
            // print_r(isset($_POST["create"]) && $_POST["create"] != "" ? "pressed" : "not pressed");
            // echo "<hr>";
            if (isset($_POST["create"]) && $_POST["nombre"] == "") {
                echo "<span class='red'>error campo</span>";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["create"]))
                echo $_POST["usuario"] ?>">
                <?php
            if (isset($_POST["usuario"]) && $_POST["usuario"] == "") {
                echo "<span class='red'>error campo</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="text" name="clave" id="clave">
            <?php
            if (isset($_POST["create"]) && $_POST["create"] != "" && $_POST["clave"] == "") {
                echo "<span class='red'>error campo</span>";
            }
            ?>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php if (isset($_POST["create"]))
                echo $_POST["email"] ?>">
                <?php
            if (isset($_POST["create"]) && $_POST["create"] != "" && $_POST["email"] == "") {
                echo "<span class='red'>error campo</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="create" value="create">Crear</button>
        </p>
        <?php
        if (isset($_SESSION["create"]) && $_SESSION["create"] != "") {
            echo $_SESSION["create"];
        }
        ?>
        <table border="1px">
            <tr>
                <th>ID</th>
                <th>nombre</th>
                <th>usuario</th>
                <th>clave</th>
                <th>email</th>
                <th>tipo</th>
            </tr>
        </table>
        <?php
        echo "<hr>";
        $list = getAllUsers();
        foreach ($list as $value) {
            foreach ($value as $key => $value2) {
                print_r($value2);
                echo "<br>";
                if ($key == "id_usuario") {
                    $tmp = $value2;
                }
                ;
            }
            echo '<button type="submit" name="del" value="' . $tmp . '">Delete</button>';
            echo "<hr>";
        }
        // var_dump(createUser("t", "t", "t", "test@gmail.com"));
        // print_r(deleteUser(37));
        ?>
    </form>
    <?php
    if (isset($_POST["del"]) && !isset($_SESSION["del"])) {
        echo deleteUser($_POST["del"]);
        $_SESSION["del"] = "eliminado con exito";
        header("Location:index.php");
        return;
    }
    if (isset($_POST["create"]) && $_POST["create"] != "") {
        if (!controlErrorForm($_POST["nombre"], $_POST["usuario"], $_POST["clave"], $_POST["email"])) {
        } else {
            createUser($_POST["nombre"], $_POST["usuario"], $_POST["clave"], $_POST["email"]);
            header("Location:index.php");
            return;
        }
    }
    ?>
</body>

</html>