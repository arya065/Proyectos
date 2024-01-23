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
function preparedStmt($conn)
{
    try {
        $sql = "select * from usuarios";
        // $stmt = $conn->prepare($sql);
        $result = "";
    } catch (PDOException $e) {
        echo "No ha podido realizar consulta: " . $e->getMessage();
    }
    return $result;
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
        // $result = $conn->query($sql)->fetch();
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
        // $result = $conn->query($sql)->fetch();
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
function addBook($ref, $titulo, $autor, $desc, $precio)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "insert into libros (referencia,titulo,autor,descripcion,precio,portada) values ($ref,'$titulo','$autor','$desc',$precio,'')";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
    }
}
