<?php
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
    print_r($respuesta);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
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