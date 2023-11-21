<?php
//сделать проверку ошибок формы
//если значения пустые, пишем что пустые, если значения неправильные, пишем что неправильные
//неправильные значения - это те, которые превышают допустимое кол-во символов
//если пользователь уже существует
//если ошибок нет, то пишем что ошибок нет и добавляем в БД


if (isset($_POST["send"])) {

    try {
        $conn = mysqli_connect("localhost", USER, PASS, "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    //name
    $error_name = is_numeric($_POST["nombre"]);
    if (strlen($_POST["nombre"]) > 20) {
        $error_name = true;
    }
    //user
    $error_user = correct_user();
    if (strlen($_POST["usuario"]) > 20) {
        $error_name = true;
    }
    //pass
    $error_pass = false;
    if (strlen($_POST["clave"]) > 50) {
        $error_pass = true;
    }
    //email
    $error_email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL); //проверяет правильно ли написан email
    if (strlen($_POST["email"]) > 50) {
        $error_email = true;
    } else if (repeated($conn, "table_name", "email")) {
        $error_email = true;
    }
    //так же проверить зарегистрирован ли эта почта
    $error_form = $error_name || $error_user || $error_pass || $error_email;
    if (!$error_form) {
        $consulta = "insert into usuarios (Usuario,Nombre,Clave,Email) values ('" . $_POST["usuario"] . "','" . $_POST["nombre"] . "','" . md5($_POST["clave"]) . "','" . $_POST["email"] . "',)";
        header("Location:index.php");
        exit;
    }
    if ($conn) {
        mysqli_close($conn);
    }
}
function correct_user()
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where Usuario = '" . $_POST["usuario"] . "'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    return mysqli_num_rows($result) > 0;
}
function repeated($conn, $table, $column)
{
    try {
        $consulta = "select * from" . $table . "where " . $column . " = '" . $_POST["usuario"] . "'";
        $result = mysqli_query($conn, $consulta);
        $result  = mysqli_num_rows($result) > 1;
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function error_pg($title, $body)
{
    $page = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>
    </head>
    <body>
        ' . $body . '
    </body>
    </html>';
    return $page;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="usuario_nuevo.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["send"])) echo $_POST["nombre"] ?>" maxlength="20">
            <?php
            if (isset($_POST["send"]) && $_POST["nombre"] == "") {
                echo '<span>*Campo vacio*</span>';
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["send"])) echo $_POST["usuario"] ?>" maxlength="20">
            <?php
            if (isset($_POST["send"]) && $_POST["usuario"] == "") {
                echo '<span>*Campo vacio*</span>';
            }
            ?>
        </p>
        <p>
            <label for="clave">Contrasena:</label>
            <input type="password" name="clave" id="clave" maxlength="50">
            <?php
            if (isset($_POST["send"]) && $_POST["clave"] == "") {
                echo '<span>*Campo vacio*</span>';
            }
            ?>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php if (isset($_POST["send"])) echo $_POST["email"] ?>" maxlength="50">
            <?php
            if (isset($_POST["send"]) && $_POST["email"] == "") {
                echo '<span>*Campo vacio*</span>';
            }
            ?>
        </p>
        <p>
            <input type="submit" value="Continuar" name="send">
            <input type="button" value="Volver" name="back">
        </p>
    </form>
</body>

</html>