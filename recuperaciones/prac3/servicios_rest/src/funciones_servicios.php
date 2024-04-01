<?php
require "conf.php";

// CREATE CONNECTION
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
function login($usuario, $clave)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios where usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $clave]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            session_name("api_prac3");
            session_start();
            $_SESSION["usuario"] = $res["usuario"];
            $_SESSION["clave"] = $res["clave"];
            return array("message" => $res, "api_session" => session_id());
        }
        return array("message" => "no existe usuario");
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'login' " . $e->getMessage());
    }
}
function salir($api_session)
{
    try {
        // session_id($api_session);
        session_name("api_prac3");
        session_start();
        // session_regenerate_id();
        session_destroy();
        return array("logout" => "Session closed");
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'login' " . $e->getMessage());
    }
}
function logueado($api_session)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios where usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["1", "1"]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            // session_name("api_prac3");
            // session_start();
            // $_SESSION["usuario"] = $res["usuario"];
            // $_SESSION["clave"] = $res["clave"];
            session_id($api_session);
            // session_name("api_prac3");
            session_start();
            return array("message" => $_SESSION);
        }
        return array("message" => "no existe usuario");
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'login' " . $e->getMessage());
    }
}