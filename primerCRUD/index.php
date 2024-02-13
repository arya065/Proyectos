<?php
require "function.php";
session_start();
// session_destroy();
// session_abort();

if (isset($_POST["enter"])) {
    $errUser = $errPass = false;
    if ($_POST["usuario"] == "") {
        $errUser = true;
    }
    if ($_POST["clave"] == "") {
        $errPass = true;
    }
    $errForm =  $errUser || $errPass;
    if (!$errForm && !ifExist($_POST["usuario"], $_POST["clave"])) {
        $errAccess = true;
    } else if (!$errForm) {
        if (userAdmin($_POST["usuario"], $_POST["clave"])) {
            $_SESSION["username"] = $_POST["usuario"];
            header("Location: views/admin/admin.php");
            return;
        } else {
            $_SESSION["username"] = $_POST["usuario"];
            header("Location: views/user.php");
            return;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        span {
            color: red;
        }

        span::before {
            content: "*";
        }

        span::after {
            content: "*";
        }
    </style>
</head>

<body>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["enter"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($errUser) && $errUser) {

                echo "<span>error usuario</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="text" name="clave" id="clave" value="<?php if (isset($_POST["enter"])) echo $_POST["clave"] ?>">
            <?php
            if (isset($errUser) && $errUser) {
                echo "<span>error clave</span>";
            }
            ?>
        </p>
        <?php
        if (isset($errAccess) && $errAccess) {
            echo "<span>error de acceso</span><br>";
        }
        ?>
        <button type="submit" name="enter">Entrar</button>
    </form>
</body>

</html>