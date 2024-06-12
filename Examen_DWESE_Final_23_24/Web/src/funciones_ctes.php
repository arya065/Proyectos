<?php
define("DIR_SERV", "http://localhost/Proyectos/Examen_DWESE_Final_23_24/servicios_rest");
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
function horarioProfesor($api_session, $id)
{
    $url = DIR_SERV . "/horarioProfesor/{$id}";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function horarioGrupo($api_session, $id)
{
    $url = DIR_SERV . "/horarioGrupo/{$id}";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function grupos($api_session)
{
    $url = DIR_SERV . "/grupos";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function aulas($api_session)
{
    $url = DIR_SERV . "/aulas";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function profesores($api_session, $dia, $hora, $id_grupo)
{
    $url = DIR_SERV . "/profesores/{$dia}/{$hora}/{$id_grupo}";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function profesoresLibres($api_session, $dia, $hora, $id_grupo)
{
    $url = DIR_SERV . "/profesoresLibres/{$dia}/{$hora}/{$id_grupo}";
    $response = consumir_servicios_REST($url, "GET", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function borrarProfesor($api_session, $dia, $hora, $id_grupo, $id_usuario)
{
    $url = DIR_SERV . "/borrarProfesor/{$dia}/{$hora}/{$id_grupo}/{$id_usuario}";
    $response = consumir_servicios_REST($url, "DELETE", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
function insertarProfesor($api_session, $dia, $hora, $id_grupo, $id_usuario, $id_aula)
{
    $url = DIR_SERV . "/insertarProfesor/{$dia}/{$hora}/{$id_grupo}/{$id_usuario}/{$id_aula}";
    $response = consumir_servicios_REST($url, "POST", ["api_session" => $api_session]);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}

function timeout($last_active)
{
    if (time() > $last_active + 10 * 60) {
        return true;
    }
    return false;
}
?>