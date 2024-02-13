<?php
define("BD_SERVER", "localhost");
define("USER", "root");
define("PASS", "qwer");
define("BD_NAME", "bd_foro2");
// echo "timeout";
function ifExist($user, $pass)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where usuario='$user' and clave='$pass'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
function userAdmin($user, $pass)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select tipo from usuarios where usuario='$user' and clave='$pass'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_fetch_assoc($result)["tipo"] == "admin") {
        return true;
    }
    return false;
}

function stillExist($user)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where usuario='$user'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
function timeout()
{
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2400)) {
        session_unset();     // unset $_SESSION
        session_destroy();   // уничтожение данных сессии
        return true;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
    return false;
}
function createNewUser($name, $user, $pass, $email, $type)
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "insert into usuarios (nombre,clave,email,usuario,tipo) values ('$name','$pass','$email','$user','$type')";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no hacer query:" . $e->getMessage() . "</p></body></html>");
    }
}
