<?php
require "config_bd.php";



function login($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario=? and clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);

    } catch (PDOException $e) {

        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        session_name("API_ExamRec_23_24");
        session_start();
        $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
        $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        $respuesta["api_session"] = session_id();
    } else {
        $respuesta["mensaje"] = "Usuario no se encuentra regis. en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
function logueado($api_session)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    session_name("API_ExamRec_23_24");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        try {
            $consulta = "select * from usuarios where usuario=? and clave=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$_SESSION["usuario"], $_SESSION["clave"]]);

        } catch (PDOException $e) {

            $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
            $sentencia = null;
            $conexion = null;
            return $respuesta;
        }

        if ($sentencia->rowCount() > 0) {
            $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
            session_name("API_ExamRec_23_24");
            session_start();
            $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
            $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        } else {
            $respuesta["mensaje"] = "Usuario no se encuentra regis. en la BD";
        }
    } else {
        $respuesta["mensaje"] = "Usuario no se encuentra regis. en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function getUser($api_session, $id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    session_name("API_ExamRec_23_24");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        try {
            $consulta = "select * from usuarios where id_usuario=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$id]);

        } catch (PDOException $e) {

            $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
            $sentencia = null;
            $conexion = null;
            return $respuesta;
        }

        if ($sentencia->rowCount() > 0) {
            $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
            session_name("API_ExamRec_23_24");
            session_start();
            $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
            $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        } else {
            $respuesta["mensaje"] = "Usuario con ($id) no se encuentra regis. en la BD";
        }
    } else {
        $respuesta["mensaje"] = "Usuario con ($id) no se encuentra regis. en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function getGuardia($api_session, $dia, $hora)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    session_name("API_ExamRec_23_24");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        try {
            $consulta = "SELECT usuarios.* FROM `usuarios`,horario_lectivo  WHERE usuarios.id_usuario = horario_lectivo.usuario and horario_lectivo.dia = ? and horario_lectivo.hora = ? and horario_lectivo.grupo = 51";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$dia, $hora]);

        } catch (PDOException $e) {

            $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
            $sentencia = null;
            $conexion = null;
            return $respuesta;
        }

        if ($sentencia->rowCount() > 0) {
            $respuesta["usuario"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            session_name("API_ExamRec_23_24");
            session_start();
            // $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
            // $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        }
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


?>