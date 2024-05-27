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
        $stmt->execute([$user, $pass]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        if (count($res)) {
            session_name("api_func");
            // session_id(session_regenerate_id());
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