<?php
define("DIR_SERV", "http://localhost/Proyectos/recuperaciones/Examen4_SW/api");
// define("DIR_SERV", "http://proyectos/recuperaciones/Examen4_SW/api");
define("INACTIVE_TIME", 5 * 60);

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
function alumnos($api_session)
{
    $url = DIR_SERV . "/alumnos";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function notasAlumno($api_session, $cod_alu)
{
    $url = DIR_SERV . "/notasAlumno/$cod_alu";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function notasNoEvalAlumno($api_session, $cod_alu)
{
    $url = DIR_SERV . "/notasNoEvalAlumno/$cod_alu";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function quitarNota($api_session, $cod_alu, $cod_asig)
{
    $url = DIR_SERV . "/quitarNota/$cod_alu";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session, "cod_asig" => $cod_asig]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function ponerNota($api_session, $cod_alu, $cod_asig)
{
    $url = DIR_SERV . "/ponerNota/$cod_alu";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session, "cod_asig" => $cod_asig]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function cambiarNota($api_session, $cod_alu, $cod_asig, $nota)
{
    $url = DIR_SERV . "/cambiarNota/$cod_alu";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session, "cod_asig" => $cod_asig, "nota" => $nota]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}

function timeout($last_active)
{
    if ($last_active + INACTIVE_TIME < time()) {
        return true;
    }
    return false;
}