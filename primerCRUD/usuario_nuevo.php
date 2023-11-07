<?php
//сделать проверку ошибок формы
//если значения пустые, пишем что пустые, если значения неправильные, пишем что неправильные
//неправильные значения - это те, которые превышают допустимое кол-во символов
//если пользователь уже существует
//если ошибок нет, то пишем что ошибок нет и добавляем в БД
function errors()
{
    // if (isset($_POST["send"])) {
    //     //name
    $error_name = false;
    //     //user
    $error_user = false;

    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from usuarios where usuario = '" . $_POST["usuario"] . "'";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }
    $error_user = mysqli_num_rows($result) > 0;


    //     //pass
    $error_pass = false;
    //     //email
    $error_email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL); //проверяет правильно ли написан email
    //так же проверить зарегистрирован ли эта почта
    $error_form = $error_name || $error_user || $error_email || $error_pass;
    if (!$error_form) {
        $consulta = "insert into usuarios (nombre,usuario,clave,email) values ('" . $_POST["nombre"] . "','" . $_POST["usuario"] . "','" . md5($_POST["clave"]) . "','" . $_POST["email"] . "',)";
        header("Location:index.php");
        exit;
    }
    if ($conn) {
        mysqli_close($conn);
    }
    // }
    // return true;


}
function repeated($conn, $table, $column, $value)
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
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["continue"])) echo $_POST["nombre"] ?>" maxlength="20">
        </p>
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["continue"])) echo $_POST["usuario"] ?>" maxlength="20">
        </p>
        <p>
            <label for="clave">Contrasena:</label>
            <input type="password" name="clave" id="clave" maxlength="50">
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php if (isset($_POST["continue"])) echo $_POST["email"] ?>" maxlength="50">
        </p>
        <p>
            <input type="submit" value="Continuar" name="continue">
            <input type="button" value="Volver" name="volver">
        </p>
    </form>
</body>

</html>