<?php
chdir(__DIR__);
require "../conf.php";
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
function getAllUsers()
{
    $url = DIR_SERV . "/usuarios";
    $answer = consumir_servicios_REST($url, "GET");
    // print_r($answer);
    $obj = json_decode($answer);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $answer);
    }
    return $obj->usuarios;
}
function createUser($nombre, $usuario, $clave, $email)
{
    $url = DIR_SERV . "/crearUsuario";
    $answer = consumir_servicios_REST($url, "GET", ["nombre" => $nombre, "usuario" => $usuario, "clave" => $clave, "email" => $email]);
    // print_r($answer);
    $obj = json_decode($answer);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $answer);
    } else {
        return $obj->result ? true : false;
    }
}
function deleteUser($id)
{
    $url = DIR_SERV . "/borrarUsuario/$id";
    $answer = consumir_servicios_REST($url, "GET");
    $obj = json_decode($answer);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $answer);
    }
    return $obj->result;
}
function controlErrorForm($nombre, $usuario, $clave, $email)
{
    if (!isset($nombre) || $nombre == "") {
        return false;
    }
    if (!isset($usuario) || $usuario == "") {
        return false;
    }
    if (!isset($clave) || $clave == "") {
        return false;
    }
    if (!isset($email) || $email == "") {
        return false;
    }
    return true;
}
