<?php
define("DIR_SERV", "http://localhost/Proyectos/recuperaciones/pruebaExamen/api");
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
function example()
{
    $url = DIR_SERV . "/example";
    $response = consumir_servicios_REST($url, "GET");
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}