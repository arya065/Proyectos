<?php
define("DIR_SERV", "http://localhost/Proyectos/API/Api_base_code/Rest");

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
$url = DIR_SERV . "/saludo";
$answer = consumir_servicios_REST($url, "GET");
$obj = json_decode($answer);
if ($obj) {
    print_r($obj->message);
} else {
    echo "error";
}
echo "<br>";

$url = DIR_SERV . "/saludo/" . urlencode("there");
$answer = consumir_servicios_REST($url, "GET");
$obj = json_decode($answer);
if (!$obj) {
    echo "error";
}
print_r($obj->message);