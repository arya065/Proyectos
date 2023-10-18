<?php
$error_form = false;
if (isset($_POST["save"])) {
    $error_name = $_POST["nombre"] == "";
    // если поле с именем пустое, пишем что ты гей
    // if ($error_name){
    //     echo "GAAAAAAAAAAAAAAAAAAAAY";
    // }

    $error_surname = $_POST["apellido"] == "";
    $error_pass = $_POST["password"] == "";
    $error_sex = !isset($_POST["sexo"]);
    $error_comment = $_POST["comment"] == "";

    $error_form = $error_name || $error_surname || $error_pass || $error_sex || $error_comment;
}
if (isset($_POST["save"]) && !$error_form) {
    echo "respuestas";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario</title>
    </head>

    <style>
        .error {
            color: red
        }
    </style>

    <body>
        <h1>Rellena tu CV</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">

            <p><label for="nom">Nombre</label></p>
            <!-- в value проверяем если ли значение в поле, если да, то оно будет там появляться даже после отправки формы -->
            <!-- если этого не сделать, то после отправки формы все поля будут отчищаться, меня смущает то, что мы сначала написали -->
            <!-- что мы сносим форму после отправки и теперь это исправляем -->
            <input type="text" id="nom" name="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">

            <!-- проверка пустого поля Nombre, если пустое, то рядом красная надпись  -->
            <?php
            if (isset($_POST["save"]) && $error_name) {
                echo "<span class = 'error'>Campo vacio</span>";
            }
            ?>

            <p><label for="ape">Apellidos</label></p>
            <input type="text" id="ape" name="apellido">

            <p><label for="pass">Contrasena</label></p>
            <input type="password" id="pass" name="password">

            <p><label for="dni">DNI</label></p>
            <input type="text" id="dni" name="dni">

            <p>Sexo</p>
            <!-- тоже самое что и сверху, проверка на наличие значения, если есть что-то, то ставим снова такое же -->
            <input type="radio" id="hom" name="sexo" value="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked" ?>>
            <label for="hom"><span>Hombre</span></label>
            <br><br>
            <input type="radio" id="muj" name="sexo" value="mujer">
            <label for="muj"><span>Mujer</span></label>

            <?php
            if (isset($_POST["save"]) && $error_sex) {
                echo "<span class = 'error'>debes seleccionar algo</span>";
            }
            ?>


            <p>
                <label for="foto"><span>Incluir mi foto:</span></label>
                <input type="file" id="foto" name="foto">
            </p>

            <p><label for="ciudad"><span>Nacido en:</span></label>
                <select name="ciudad" id="ciudad">
                    <option value="1" <?php if (!isset($_POST["ciudad"]) || (isset($_POST["ciudad"]) && $_POST["ciudad"] == "1")) echo "selected" ?>>Malaga</option>
                    <option value="2" <?php if (!isset($_POST["ciudad"]) || (isset($_POST["ciudad"]) && $_POST["ciudad"] == "2")) echo "selected" ?>>no Malga</option>
                    <option value="3">no no Malaga</option>
                    <option value="4">no no no Malaga</option>
                </select>
            </p>

            <p>
                <label for="comm"><span>Comentarios:</span></label>
                <textarea name="comment" id="comm" cols="30" rows="10"></textarea>
            </p>

            <p>
                <input type="checkbox" id="sub" name="sub">
                <label for="sub">Subscribirse al bolerin de Novedades</label>
            </p>

            <p>
                <input type="submit" value="Guardar cambios" name="save">
                <input type="reset" value="Borrar los datos introducidos" name="reset">
            </p>
        </form>
    </body>

    </html>

<?php
}
?>