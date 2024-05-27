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
function login($user, $pass)
{
    $url = DIR_SERV . "/login";
    $response = consumir_servicios_REST($url, "GET", ["usuario" => $user, "clave" => $pass]);
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
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function usuario($api_session,$id)
{
    $url = DIR_SERV . "/usuario/$id";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function usuariosGuardia($api_session, $dia, $hora)
{
    $url = DIR_SERV . "/usuariosGuardia/$dia/$hora";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}