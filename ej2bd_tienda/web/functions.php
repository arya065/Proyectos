<?php
define("DIR_SERV", "http://localhost/Proyectos/ej2bd_tienda/api/");
// ASK API
function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}
function getAllProd()
{
    $url = DIR_SERV . "/productos";
    $response = consumir_servicios_REST($url, "GET");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function getProdCod($code)
{
    $url = DIR_SERV . "/producto/$code";
    $response = consumir_servicios_REST($url, "GET");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function insertProd($code, $nombre, $nombreCorto, $descr, $pvp, $familia)
{
    $url = DIR_SERV . "/producto/insertar";
    $response = consumir_servicios_REST($url, "PUT", ["codigo" => $code, "nombre" => $nombre, "nombreCorto" => $nombreCorto, "descripcion" => $descr, "pvp" => $pvp, "familia" => $familia]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function updateProd($code, $nombre, $nombreCorto, $descr, $pvp, $familia)
{
    $url = DIR_SERV . "/producto/actualizar/$code";
    $response = consumir_servicios_REST($url, "GET", ["codigo" => $code, "nombre" => $nombre, "nombreCorto" => $nombreCorto, "descripcion" => $descr, "pvp" => $pvp, "familia" => $familia]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function delProd($code)
{
    $url = DIR_SERV . "/producto/borrar/$code";
    $response = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function getFamilias()
{
    $url = DIR_SERV . "/familias";
    $response = consumir_servicios_REST($url, "GET");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function getRepeated($table, $col, $value)
{
    $url = DIR_SERV . "/repetido/$table/$col/$value";
    $response = consumir_servicios_REST($url, "GET");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function getRepeatedEdit($table, $col, $value, $col_id, $value_id)
{
    $url = DIR_SERV . "/repetido/$table/$col/$value/$col_id,$value_id";
    $response = consumir_servicios_REST($url, "GET");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}