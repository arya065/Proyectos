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
        $sql = "SELECT * from usuarios where usuario=? and clave=?";
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
        return json_encode(array("mensaje" => "usuario no se encuentra registrado en la bd"));
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
        return json_encode(array("mensaje" => "no se encuentra registrado en la bd"));
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

function horarioProfesor($api_session, $id)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT dia,hora,grupo,aula,grupos.nombre from horario_lectivo join usuarios on usuarios.id_usuario=horario_lectivo.usuario join grupos on horario_lectivo.grupo=grupos.id_grupo where horario_lectivo.usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("horarioProfesor" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function horarioGrupo($api_session, $id)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT dia,hora,horario_lectivo.usuario as id,aula,usuarios.usuario from horario_lectivo join grupos on grupos.id_grupo=horario_lectivo.grupo JOIN usuarios on horario_lectivo.usuario=usuarios.id_usuario where horario_lectivo.grupo=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("horarioGrupo" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function grupos($api_session)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from grupos";
            $stmt = $conn->prepare($sql);
            $stmt->execute([]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("grupos" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function aulas($api_session)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from aulas";
            $stmt = $conn->prepare($sql);
            $stmt->execute([]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("aulas" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function profesores($api_session, $dia, $hora, $id)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT * from usuarios JOIN horario_lectivo on usuarios.id_usuario=horario_lectivo.usuario WHERE grupo=? and dia=? and hora=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id, $dia, $hora]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("profesores" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}

function profesoresLibres($api_session, $dia, $hora, $id)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "SELECT usuarios.id_usuario,horario_lectivo.grupo,horario_lectivo.dia,horario_lectivo.hora from usuarios LEFT JOIN horario_lectivo on usuarios.id_usuario=horario_lectivo.usuario and horario_lectivo.dia=? and horario_lectivo.hora=? and horario_lectivo.grupo=? and usuarios.tipo='normal' WHERE horario_lectivo.grupo is null";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dia, $hora, $id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("grupos" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function borrarProfesor($api_session, $dia, $hora, $id_grupo, $id_usuario)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "DELETE from horario_lectivo where dia=? and hora=? and grupo=? and usuario=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("grupos" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}
function insertarProfesor($api_session, $dia, $hora, $id_grupo, $id_usuario, $id_aula)
{
    session_name("api_func");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $api_session == $_SESSION["api_session"]) {
        try {
            $conn = createConn();
            $sql = "INSERT INTO horario_lectivo ('usuario','dia','hora','grupo','aula') value (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario, $dia, $hora, $id_grupo, $id_aula]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("grupos" => $res, "api_session" => $api_session));
        } catch (PDOException $e) {
            $conn = null;
            return json_encode(array("error" => $e->getMessage()));
        }
    } else {
        return json_encode(array("error" => "no existe api_session"));
    }
}

?>