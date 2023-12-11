<?php
define("BD_SERVER", "localhost");
define("USER", "root");
define("PASS", "qwer");
define("BD_NAME", "bd_foro2");

function err_page()
{
    $page = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    </head>
    <body>
    
    </body>
    </html>';
    return $page;
}
function timeout()
{
    if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > 1440)) { //have we expired?
        echo "exipired";
        session_destroy();
        header('Location: expired.php');
        return;
    } else { //if we haven't expired
        echo "not exipired";
        $_SESSION['last_activity'] = time();
    }
    echo "last activity: ", $_SESSION['last_activity'];
}
function existInBD($user)
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
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
