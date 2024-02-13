<?php
function createConn()
{
    try {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];
        $conn = new PDO("mysql:host=localhost;dbname=bd_libreria_exam", "jose", "josefa", $opt);
        return $conn;
    } catch (PDOException $e) {
        echo "No ha podido crear conexion: " . $e->getMessage();
    }
}
function stillExist($user, $conn)
{
    try {
        $sql = "select * from usuarios where lector='$user'";
        $result = $conn->query($sql)->fetch();
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    return $result;
}
function timeout()
{
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 120)) {
        session_unset();
        session_destroy();
        return true;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
    return false;
}
function ifAdm($name, $conn)
{
    try {
        $sql = "select * from usuarios where lector=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt->fetch();
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    if ($result && $result['tipo'] == "admin") {
        return true;
    }
    return false;
}
function ifExist($name, $pass, $conn)
{
    try {
        $sql = "select * from usuarios where lector=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $pass]);
        $result = $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    return $result;
}
function getAllBooks($conn)
{
    try {
        $sql = "select * from libros";
        $result = $conn->query($sql);
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    return $result;
}
function del($ref, $conn)
{
    try {
        $sql = "delete from libros where referencia ='$ref'";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    return $result;
}
function repeatRef($ref, $conn)
{
    try {
        $sql = "select * from libros where referencia=$ref";
        $result = $conn->query($sql);
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    return $result;
}
function correctNum($num)
{
    if ($num <= 0) {
        return false;
    }
    if (!is_numeric($num)) {
        return false;
    }
    return true;
}
function addBook($ref, $titulo, $autor, $desc, $precio, $conn)
{
    $sql = "insert into libros (referencia,titulo,autor,descripcion,precio,portada) values (?,?,?,?,?,'')";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$ref, $titulo, $autor, $desc, $precio]);
    return $result;
}
