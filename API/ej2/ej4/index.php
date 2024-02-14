<?php
require "./function.php";
require "../conf.php";
session_start();
if (isset($_SESSION["del"])) {
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
</head>

<body>
    <h1>CRUD</h1>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="text" name="clave" id="clave">
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
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
                };
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
        $_SESSION["del"] = 1;
        header("Location:index.php");
        return;
    }
    if (isset($_POST["create"]) && $_POST["create"] != "") {
        if (!controlErrorForm($_POST["nombre"], $_POST["usuario"], $_POST["clave"], $_POST["email"])) {
            echo "*error formulario*";
            $_SESSION["create"] = "error formulario";
        } else {
            createUser($_POST["nombre"], $_POST["usuario"], $_POST["clave"], $_POST["email"]);
            echo "*user added*";
            $_SESSION["create"] = "usuario creado";
        }
        header("Location:index.php");
        return;
    }
    ?>
</body>

</html>