<?php

define("DIR_SERV", "http://proyectos/recuperaciones/Examen_SW_22_23/servicios_rest");
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
function login($user, $pass)
{
    $url = DIR_SERV . "/login";
    $response = consumir_servicios_REST($url, "POST", ["usuario" => $user, "clave" => $pass]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function logueado($api_session)
{
    $url = DIR_SERV . "/logueado";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function salir($api_session)
{
    $url = DIR_SERV . "/salir";
    $response = consumir_servicios_REST($url, "POST", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function timeout($last_active)
{
    if (time() > $last_active + 5 * 60) {
        return true;
    }
    return false;
}

