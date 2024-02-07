<?php
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
function createConn()
{
    try {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        $conn = new PDO("mysql:host=localhost;dbname=bd_tienda", "jose", "josefa", $opt);
        return $conn;
    } catch (PDOException $e) {
        echo "No ha podido crear conexion: " . $e->getMessage();
    }
}
function getAllProd()
{
    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
    return $obj;
}
function getProdCod($cod)
{
    $url = DIR_SERV . "/producto/$cod";
    $respuesta = consumir_servicios_REST($url, "GET");
    print_r($respuesta);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
}
function insertProd($name)
{
    $url = DIR_SERV . "/producto/insertar/$name";
    $respuesta = consumir_servicios_REST($url, "PUT");
    print_r($respuesta);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
}
function actualizarProd($cod)
{
    $url = DIR_SERV . "/producto/actualizar/$cod";
    $respuesta = consumir_servicios_REST($url, "GET");
    print_r($respuesta);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
}
function borrarProd($cod)
{
    $url = DIR_SERV . "/producto/borrar/$cod";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    print_r($respuesta);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
}
function existTablaColumnaValor($tabla, $columna, $valor)
{
    $url = DIR_SERV . "/repetido/$tabla/$columna/$valor";
    $respuesta = consumir_servicios_REST($url, "GET");
    print_r($respuesta);
    $obj = json_decode($respuesta);
    // print_r($obj);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
}
function existTablaColumnaValorId($tabla, $columna, $valor, $id)
{
    $url = DIR_SERV . "/repetido/$tabla/$columna/$valor/" . getColumnName($tabla) . "/$id";
    $respuesta = consumir_servicios_REST($url, "GET");
    print_r($respuesta);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
}
function getColumnName($table)
{
    $conn = createConn();
    $sql = "DESCRIBE $table";
    $res = $conn->query($sql)->fetchAll();
    return $res[0]["Field"];
}