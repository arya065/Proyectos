<?php
require "config_bd.php";
function createConn()
{
    try {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        $conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, USER, PASS, $opt);
        return $conn;
    } catch (PDOException $e) {
        echo "No ha podido crear conexion: " . $e->getMessage();
    }
}
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
function getUser($id, $api_session)
{
    $url = DIR_SERV . "/usuario/$id";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function getGuardia($dia, $hora, $api_session)
{
    echo "<br>here<br>";
    $url = DIR_SERV . "/usuariosGuardia/$dia/$hora";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function getGuardiaUser($dia, $hora, $id, $api_session)
{
    $url = DIR_SERV . "/usuariosGuardia/$dia/$hora/$id";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
