<?php
require "config_bd.php";
function createConn()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        return $conexion;
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
            session_start();
            session_regenerate_id();
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
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "SELECT * from usuarios where usuario=? and clave=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_SESSION["usuario"], md5($_SESSION["clave"])]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("usuario" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function salir($api_session)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    session_destroy();
    return json_encode(array("logout" => "session cerrada"));
}
function alumnos($api_session)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "SELECT * from usuarios where tipo='alumno'";
            $stmt = $conn->prepare($sql);
            $stmt->execute([]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("usuario" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function notasAlumno($api_session, $cod_alu)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "SELECT u.cod_usu, u.usuario, a.denominacion, n.nota FROM usuarios AS u JOIN notas AS n ON u.cod_usu = n.cod_usu JOIN asignaturas AS a ON n.cod_asig = a.cod_asig WHERE u.cod_usu = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$cod_alu]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("notas" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function notasNoEvalAlumno($api_session, $cod_alu)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "SELECT n.cod_usu, a.cod_asig, a.denominacion from notas AS n right JOIN asignaturas AS a ON n.cod_asig = a.cod_asig and n.cod_usu = ? WHERE n.cod_usu is null";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$cod_alu]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("notas" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function quitarNota($api_session, $cod_alu, $cod_asig)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "DELETE from notas where cod_usu = ? and cod_asig = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$cod_alu, $cod_asig]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("resultado" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function ponerNota($api_session, $cod_alu, $cod_asig)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "INSERT INTO notas (cod_asig,cod_usu,nota) values (?,?,0)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$cod_asig, $cod_alu]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("resultado" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function cambiarNota($api_session, $cod_alu, $cod_asig, $nota)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"]) && $_SESSION["api_session"] == $api_session) {
            $conn = createConn();
            $sql = "UPDATE notas set nota=? where cod_asig=? and cod_usu=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nota, $cod_asig, $cod_alu]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("resultado" => $res, "api_session" => $api_session));
        } else {
            return json_encode(array("error" => "no tienes permisos para utilizar este api"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
?>