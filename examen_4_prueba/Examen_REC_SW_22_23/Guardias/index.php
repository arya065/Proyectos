<?php
require "../servicios_rest/src/funciones_servicios.php";
getApiSession();
if (isset($_SESSION["user"])) {
    echo "exist";
}

function errores()
{
    $err_form = false;
    if (isset($_POST["enter"])) {
        if ($_POST["usuario"] == "") {
            $err_form = true;
        }
        if ($_POST["clave"] == "") {
            $err_form = true;
        }
        return $err_form;
    }
    return true;
}
function getApiSession()
{
    if (!errores()) {
        $tmp = login($_POST["usuario"], $_POST["clave"]);
        $api_session = $tmp->api_session;
        session_id($api_session);
        session_start();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Guardias</title>
    <style>
        .red {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Gestion de Guardias</h1>
    <?php
    if (isset($_SESSION["user"])) {
        header("Location: guardias.php");
        exit;
    } else {
        ?>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"]))
                    echo $_POST["usuario"]; ?>">
                <?php
                if (isset($_POST["enter"]) && $_POST["usuario"] == "") {
                    echo "<span class='red'>error</span>";
                }
                ?>
            </p>
            <p>
                <label for="clave">Contrasena:</label>
                <input type="password" name="clave" id="clave">
                <?php
                if (isset($_POST["enter"]) && $_POST["clave"] == "") {
                    echo "<span class='red'>error</span>";
                }
                ?>
            </p>
            <p>
                <button type="submit" name="enter" value="enter">Entrar</button>
            </p>
        </form>
        <?php
    }
    ?>
</body>

</html>