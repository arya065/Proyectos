<?php
require("functions.php");
// session_destroy();
if (isset($_POST["login"])) {
    $err_user = $_POST["usuario"] == "";
    $err_pass = $_POST["clave"] == "";
    $err_form = $err_user || $err_pass;

    if (!$err_form) {
        if (!existUser($_POST["usuario"], $_POST["clave"])) {
            $err_user = true;
        } else {
            if (!isset($_SESSION["login"]) || $_SESSION["login"] == "") {
                session_name("Primer_login");
                session_start();
                $_SESSION["login"] = $_POST["usuario"];
                header("Location: login.php");
                return;
            }
        }
    }
}

function existUser($user, $pass)
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
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
function ini_connect()
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from table";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    .red {
        color: red;
    }

    .red::before {
        content: "*";
    }

    .red::after {
        content: "*";
    }
</style>

<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["login"]) && $err_user) {
                echo '<span class="red">Error in username</span>';
            }
            ?>
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave">
            <?php
            if (isset($_POST["login"]) && $err_pass) {
                echo '<span class="red">Error in password</span>';
            }
            ?>
        </p>
        <p>
            <button type="submit" name="login">Log in</button>
        </p>
    </form>
    <?php
    ?>
</body>

</html>