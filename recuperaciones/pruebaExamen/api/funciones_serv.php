<?php
require "conf.php";

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
function login($user, $pass)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios where usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user, md5($pass)]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        if (count($res)) {
            session_name("api_func");
            // session_id(session_regenerate_id());
            session_start();
            $session_api = session_id();
            $_SESSION["usuario"] = $user;
            $_SESSION["clave"] = $pass;
            $_SESSION["api_session"] = $session_api;
        }
        return json_encode(array("usuario" => $res, "api_session" => $session_api));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function logueado($api_session)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from usuarios where usuario=? and clave=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_SESSION["usuario"], md5($_SESSION["clave"])]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("usuario" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function salir($api_session)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    session_regenerate_id();
    session_destroy();
    return json_encode(array("log_out" => "Cerrada sesion en la API"));
}
function usuario($api_session, $id)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from usuarios where id_usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("usuario" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    }
}
function usuariosGuardia($api_session, $dia, $hora)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from horario_lectivo where dia=? and hora=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dia, $hora]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("usuarios" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    }
}