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

function loggedIn($api_session)
{
    session_name("api_prac3");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $api_session) {
        return true;
    }
    return false;
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
            $_SESSION["api_session"] = session_id();
            return array("message" => $res, "api_session" => $_SESSION["api_session"]);
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
    session_name("api_prac3");
    session_id($api_session);
    session_start();
    // session_regenerate_id();
    session_unset();
    session_destroy();
    return array("logout" => "Session closed");
}
function logueado($api_session)
{
    return loggedIn($api_session);
}
// _____________________________________________________________________ not tested
function usuarios($api_session)
{
    if (loggedIn($api_session)) {
        try {
            $conn = createConn();
            $sql = "SELECT * from usuarios";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array("message" => $res);
        } catch (PDOException $e) {
            $stmt = null;
            $conn = null;
            return array("error" => "Error metodo 'logueado' " . $e->getMessage());
        }
    }
}

function registrar($api_session, $usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo)
{
    try {
        $conn = createConn();
        $sql = "INSERT into usuarios (usuario,clave,nombre,dni,sexo,foto,subscripcion,tipo) values (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array("message" => $res);
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'logueado' " . $e->getMessage());
    }
}

function paginacion($api_session, $page, $num)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios limit ?,?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([($page - 1) * $num, $num]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array("message" => $res);
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'logueado' " . $e->getMessage());
    }
}

function usuario($api_session, $id)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array("message" => $res);
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'logueado' " . $e->getMessage());
    }
}

function borrar($api_session, $id)
{
    try {
        $conn = createConn();
        $sql = "DELETE * from usuarios where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array("message" => $res);
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'logueado' " . $e->getMessage());
    }
}

function editar($api_session, $id, $usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo)
{
    try {
        $conn = createConn();
        $sql = "UPDATE usuarios set usuario=?,clave=?,nombre=?,dni=?,sexo=?,foto=?,subscripcion=?,tipo=? where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo, $id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array("message" => $res);
    } catch (PDOException $e) {
        $stmt = null;
        $conn = null;
        return array("error" => "Error metodo 'logueado' " . $e->getMessage());
    }
}
