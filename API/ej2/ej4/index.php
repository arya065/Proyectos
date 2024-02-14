<?php
require "./function.php";
require "../conf.php";
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
    <h1>Login</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>nombre</th>
            <th>usuario</th>
            <th>clave</th>
            <th>email</th>
            <th>tipo</th>
        </tr>
        <?php
        // print_r(getAllUsers());
        // var_dump(createUser("t", "t", "t", "test@gmail.com"));
        print_r(deleteUser(37));
        ?>
    </table>
    <form action="index.php" method="post">

    </form>
</body>

</html>