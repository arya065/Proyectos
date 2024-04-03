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
    return array("message" => loggedIn($api_session));
}
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
            return array("error" => "Error metodo 'usuarios' " . $e->getMessage());
        }
    } else {
        return array("message" => "Not logged in");
    }
}

function registrar($api_session, $usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo)
{
    if (loggedIn($api_session)) {
        try {
            $conn = createConn();
            $sql = "INSERT into usuarios (usuario,clave,nombre,dni,sexo,foto,subscripcion,tipo) values (?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array("message" => $stmt->rowCount() == 1 ? "Usuario registrado" : "Usuario no registrado");
        } catch (PDOException $e) {
            $stmt = null;
            $conn = null;
            return array("error" => "Error metodo 'registrar' " . $e->getMessage());
        }
    } else {
        return array("message" => "Not logged in");
    }
}

function paginacion($api_session, $page, $num)
{
    if (loggedIn($api_session)) {
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
            return array("error" => "Error metodo 'paginacion' " . $e->getMessage());
        }
    } else {
        return array("message" => "Not logged in");
    }
}

function usuario($api_session, $id)
{
    if (loggedIn($api_session)) {
        try {
            $conn = createConn();
            $sql = "SELECT * from usuarios where id_usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array("message" => $res);
        } catch (PDOException $e) {
            $stmt = null;
            $conn = null;
            return array("error" => "Error metodo 'usuario' " . $e->getMessage());
        }
    } else {
        return array("message" => "Not logged in");
    }
}

function borrar($api_session, $id)
{
    if (loggedIn($api_session)) {
        try {
            $conn = createConn();
            $sql = "DELETE from usuarios where id_usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array("message" => $stmt->rowCount() == 1 ? "Usuario borrado" : "Usuario no borrado");
        } catch (PDOException $e) {
            $stmt = null;
            $conn = null;
            return array("error" => "Error metodo 'borrar' " . $e->getMessage());
        }
    } else {
        return array("message" => "Not logged in");
    }
}

function editar($api_session, $id, $usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo)
{
    if (loggedIn($api_session)) {
        try {
            $conn = createConn();
            $sql = "UPDATE usuarios set usuario=?,clave=?,nombre=?,dni=?,sexo=?,foto=?,subscripcion=?,tipo=? where id_usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario, $clave, $nombre, $dni, $sexo, $foto, $subscripcion, $tipo, $id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array("message" => $stmt->rowCount() == 1 ? "Usuario modificado" : "Usuario no modificado");
        } catch (PDOException $e) {
            $stmt = null;
            $conn = null;
            return array("error" => "Error metodo 'editar' " . $e->getMessage());
        }
    } else {
        return array("message" => "Not logged in");
    }
}
