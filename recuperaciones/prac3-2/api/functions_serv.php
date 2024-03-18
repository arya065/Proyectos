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

function getProductos()
{
    try {
        $conn = createConn();
        $sql = "SELECT * from producto";
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
function getProductosCode($code)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from producto where cod=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$code]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => $res));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function insertProducto($code, $nombre, $nombreCorto, $descr, $pvp, $familia)
{
    try {
        $conn = createConn();
        $sql = "INSERT into producto (cod,nombre,nombre_corto,descripcion,PVP,familia) values (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$code, $nombre, $nombreCorto, $descr, $pvp, $familia]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => "El producto con nombre $nombreCorto se ha insertado correctamente"));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}