<?php
require "config_bd.php";

function conexion_pdo()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $respuesta["mensaje"] = "Conexi&oacute;n a la BD realizada con &eacute;xito";

        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }
    return $respuesta;
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
        }
        return json_encode(array("usuario" => $res, "api_session" => $session_api));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
?>