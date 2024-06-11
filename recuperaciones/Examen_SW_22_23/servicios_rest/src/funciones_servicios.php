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
function login($user, $pass)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios where lector=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user, md5($pass)]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        if (count($res)) {
            session_name("api_func");
            session_start();
            $session_api = session_id();
            $_SESSION["usuario"] = $user;
            $_SESSION["clave"] = $pass;
            $_SESSION["api_session"] = $session_api;
            return json_encode(array("usuario" => $res, "api_session" => $session_api));
        }
        return json_encode(array("mensaje" => "mensaje de error"));
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
            $sql = "SELECT * from usuarios where lector=? and clave=?";
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
        return json_encode(array("error" => "no tienes permisos"));
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

function obtenerLibros($api_session)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from libros";
            $stmt = $conn->prepare($sql);
            $stmt->execute([]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("libros" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no tienes permisos"));
    }
}
function crearLibro($api_session, $referencia, $titulo, $autor, $descripcion, $precio, $portada)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "INSERT INTO libros ('referencia','titulo','autor','descripcion','precio','portada') values (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$referencia, $titulo, $autor, $descripcion, $precio, $portada]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("mensaje" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no tienes permisos"));
    }
}
function actualizarPortada($api_session, $portada, $referencia)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "UPDATE libros set portada=? where referencia=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$portada, $referencia]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("mensaje" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no tienes permisos"));
    }
}
function repetido($api_session, $tabla, $columna, $valor)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from $tabla where $columna=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$valor]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            if (count($res)) {
                return json_encode(array("repetido" => true, "api_session" => $api_session));
            } else {
                return json_encode(array("repetido" => false, "api_session" => $api_session));
            }
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no tienes permisos"));
    }
}
?>