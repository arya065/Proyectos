<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require "../primera_api/functions.php";
    define("DIR_SERV", "http://localhost/Proyectos/API/ej1/primera_api");
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
    function formInsert()
    {
        ?>
        <form action="index.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <br>
            <input type="submit" value="send">
        </form>
        <?php
    }
    // getProdCod("1");
    // echo "<br>__________________________<br>";
    // formInsert();
    // if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {
    //     insertProd($_POST["nombre"]);
    // }
    // echo "<br>__________________________<br>";
    // actualizarProd(1);
    // echo "<br>__________________________<br>";
    // borrarProd(17);
    // echo "<br>__________________________<br>";
    // existTablaColumnaValor("productos", "nombre", "nam2");
    // existTablaColumnaValorId("productos", "nombre", "nam2", 1);
    ?>
</body>

</html>