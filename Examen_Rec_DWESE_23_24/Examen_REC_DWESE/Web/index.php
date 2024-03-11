<?php
session_name("ExamenRec_SW_23_24");
session_start();

?>
<?php
$_SESSION["act"] = time();
require "functions.php";
function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}
if (isset($_POST["enter"])) {
    if ($_POST["usuario"] !== "" && $_POST["clave"] !== "") {
        $response = json_decode(consumir_servicios_REST("/login", "GET", ["usuario" => $_POST["usuario"], "clave" => $_POST["clave"]]));
        $_SESSION["usuario"] = $response->usuario->usuario;
        $_SESSION["clave"] = $response->usuario->clave;
        $_SESSION["id"] = $response->usuario->id_usuario;
        $_SESSION["api_session"] = $response->api_session;
    }
    if (isset($_SESSION["usuario"])) {
        header("Location: gestion.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de guardias</title>
    <style>
        .red {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Gestion de guardias</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"]))
                echo $_POST["usuario"] ?>">
                <?php
            if (isset($_POST["enter"]) && $_POST["usuario"] == "") {
                echo '<span class="red">*error vacio*</span>';
            }
            ?>
        </p>
        <p>
            <label for="clave">Contrasena:</label>
            <input type="password" name="clave" id="clave">
            <?php
            if (isset($_POST["enter"]) && $_POST["usuario"] == "") {
                echo '<span class="red">*error vacio*</span>';
            }
            ?>
        </p>
        <?php
        if (isset($_POST["enter"]) && isset($_SESSION["usuario"])) {
            $response = json_decode(consumir_servicios_REST("/usuario/" . $_SESSION["id"] . "", "GET", ["api_session" => $_SESSION["api_session"]]));
            if ($response->mensaje) {
                echo '<span class="red">*error no registrado*</span>';
            }
        }
        ?>
        <button type="submit" name="enter" value="enter">Entrar</button>
    </form>
</body>

</html>
<?php

?>