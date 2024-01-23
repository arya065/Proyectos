<?php
require("function.php");
session_start();
$conn = createConn();

// print_r($_SESSION);
// session_destroy();
function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location:index.php");
    return;
} else if (isset($_SESSION["usuario"]) && isset($_SESSION["usuarioNormal"]) && $_SESSION["usuarioNormal"]) {
    if (!timeout() && stillExist($_SESSION["usuario"]) && $_SESSION["usuarioNormal"]) {
        echo '<form action="index.php" method="post">';
        echo '<p>Bienvenido <b>' . $_SESSION["usuario"] . '</b> - <button type="submit" name="logout">Salir</button></p>';
        echo '</form>';
    } else {
        session_destroy();
        header("Location: index.php");
        return;
    }
} else if (isset($_POST["enter"])) {
    // form
    $errLector = $errClave = $errAccess = false;
    if ($_POST["usuario"] == "") {
        $errLector = true;
    }
    if ($_POST["clave"] == "") {
        $errClave = true;
    }
    if (!ifExist($_POST["usuario"], $_POST["clave"])) {
        $errAccess = true;
    }
    $errForm = $errClave || $errLector || $errAccess;
    //no errors in form
    if (!$errForm) {
        if (ifAdm($_POST["usuario"])) {
            $_SESSION["usuario"] = $_POST['usuario'];
            $_SESSION["usuarioNormal"] = false;
            header("Location: admin/gest_libros.php");
            return;
        } else {
            $_SESSION["usuario"] = $_POST['usuario'];
            $_SESSION["usuarioNormal"] = true;
            header("Location: index.php");
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

        #libros {
            display: flex;
            flex-direction: row;
            width: 100%;
            border: none;
        }

        div {
            width: 30%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            border: 1px solid black;
            margin: auto;
            margin-bottom: 10px;
        }

        div img {
            width: 100%;
        }

        div p {
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Libreria</h1>
    <?php
    if (isset($_SESSION["usuario"]) && isset($_SESSION["usuarioNormal"]) && $_SESSION["usuarioNormal"]) {
    } else {
    ?>
        <form action="index.php" method="post">
            <?php

            if (isset($errAccess) && $errAccess && !$errClave && !$errLector) {
                echo '<span>*Error de accesso*</span>';
            }
            ?>
            <p><label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["enter"])) echo $_POST["usuario"] ?>"></p>
            <?php
            if (isset($errLector) && $errLector) {
                echo '<span>*Error de usuario*</span>';
            }
            ?>
            <p><label for="clave">Contrasena</label><input type="text" name="clave" id="clave" value="<?php if (isset($_POST["enter"])) echo $_POST["clave"] ?>"></p>
            <?php
            if (isset($errClave) && $errClave) {
                echo '<span>*Error de clave*</span>';
            }
            ?>
            <p><button type="submit" name="enter">Entrar</button></p>
        <?php
    }
        ?>
        </form>
        <h2>Listado de los libros</h2>
        <div id="libros">
            <?php
            var_dump(ifExist("t1", "t1", $conn));
            echo "<br>";
            var_dump(ifAdm("t1", $conn));
            
            $list = getAllBooks($conn);
            foreach ($list as $line) {
                echo '<div>';
                echo '<img src="Images/' . $line["portada"] . '" alt="img">';
                echo '<p>' . $line["titulo"] . ' - ' . $line["precio"] . ' euros</p>';
                echo '</div>';
            }
            ?>
        </div>
</body>

</html>
<?php
// }
?>