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
function example()
{
    try {
        $conn = createConn();
        $sql = "SELECT * from categorias";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => $res));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function login($user, $pass)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from usuarios where usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user, $pass]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        if (count($res)) {
            // session_name("api_func");
            session_id(session_regenerate_id());
            session_start();
            $session_api = session_id();
            $_SESSION["usuario"] = $user;
        }
        return json_encode(array("response" => $res, "session_api" => $session_api));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function insertarUsuario($user, $pass, $email, $api_session)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"])) {
            echo "exist<br>";
            $conn = createConn();
            $sql = "INSERT into usuarios (usuario,clave,email) values (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user, $pass, $email]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("response" => $res));
        } else {
            return json_encode(array("response" => "session id is not correct"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function usuarios($columna, $valor, $api_session)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"])) {
            $conn = createConn();
            $sql = "SELECT * from usuarios where $columna =?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$valor]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("response" => $res));
        } else {
            return json_encode(array("response" => "session id is not correct"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function comentarios($id, $api_session)
{
    try {
        session_name("api_func");
        session_id($api_session);
        session_start();
        if (isset($_SESSION["usuario"])) {
            $conn = createConn();
            $sql = "SELECT * from comentarios where idComentario =?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return json_encode(array("response" => $res));
        } else {
            return json_encode(array("response" => "session id is not correct"));
        }
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}

/**
 * $app->get("/usuario/{id}", function () { });
 * $app->get("/noticia/{id}", function () { });
 * $app->get("/categoria/{id}", function () { });
 * $app->get("/comentario/{id}", function () { });
 * $app->get("/actualizarComentario/{id}", function () { });
 * $app->get("/borrarComentario/{id}", function () { });
 */
