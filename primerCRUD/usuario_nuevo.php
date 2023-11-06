<?php
//сделать проверку ошибок формы
//если значения пустые, пишем что пустые, если значения неправильные, пишем что неправильные
//неправильные значения - это те, которые превышают допустимое кол-во символов
//если ошибок нет, то пишем что ошибок нет и добавляем в БД
function errors()
{
    // if (isset($_POST["send"])) {
    //     //name
    //     //user
    //     //pass
    //     //email
    //     $err = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);//проверяет правильно ли написан email
        
    // }
    // return true;
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