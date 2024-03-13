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
function updateProd($code, $nombre, $nombreCorto, $descr, $pvp, $familia)
{
    try {
        $conn = createConn();
        $sql = "UPDATE producto set nombre =?, nombre_corto=?, descripcion=?, PVP=?, familia=? where cod = ?";
        $stmt = $conn->prepare($sql);
        $tmp = $stmt->execute([$nombre, $nombreCorto, $descr, $pvp, $familia, $code]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => "El producto con nombre $nombreCorto se ha actualizado correctamente"));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function delProd($code)
{
    try {
        $conn = createConn();
        $sql = "DELETE from producto where cod = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$code]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => "El producto con codigo $code se ha borrado correctamente"));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function getFamilias()
{
    try {
        $conn = createConn();
        $sql = "SELECT * from familia";
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
function repeated($table, $col, $value)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from $table where $col = ?";
        $stmt = $conn->prepare($sql);
        $tmp = $stmt->execute([$value]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => $res));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}
function repeatedEdit($table, $col, $value, $col_id, $value_id)
{
    try {
        $conn = createConn();
        $sql = "SELECT * from $table where $col = ? and $col_id != ?";
        $stmt = $conn->prepare($sql);
        $tmp = $stmt->execute([$value, $value_id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return json_encode(array("answer" => $res));
    } catch (PDOException $e) {
        $conn = null;
        return json_encode(array("error" => $e->getMessage()));
    }
}