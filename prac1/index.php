<?php
$error_form = false;
if (isset($_POST["send"])) {
    $err_name = $_POST["name"] == "";
    $err_sex = !isset($_POST["sexo"]);
    $err_hobby = !isset($_POST["hobby"]);
    $error_comment = $_POST["comment"];

    $error_form = $err_name || $err_sex || $err_hobby || $err_hobby;
}
if (isset($_POST["send"]) && !$error_form) {
    echo "todo bien";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mi primera pagina web</title>
    </head>
    <style>
        .error {
            color: red;
        }
    </style>

    <body>
        <h1>Esta es mi super pagina</h1>
        <form action="" method="post">
            <p>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="<?php if (isset($_POST["name"])) echo $_POST["name"] ?>">
                <?php
                if (isset($_POST["send"]) && $err_name) {
                    echo "<span class = 'error'>*Campo vacio*</span>";
                }
                ?>
            </p>

            <p>
                <label for="birth">Nacido en:</label>
                <select name="birth" id="birth">
                    <option value="Malaga"
                    <?php if (!isset($_POST["birth"]) || (isset($_POST["birth"]) && $_POST["birth"] == "Malaga")) echo "selected" ?>>
                        Malaga
                    </option>
                    <option value="No Malaga"
                    <?php if (!isset($_POST["birth"]) || (isset($_POST["birth"]) && $_POST["birth"] == "No Malaga")) echo "selected" ?>>
                        No Malaga
                    </option>
                </select>
            </p>

            <p>
                Sexo:
                <label for="man">Hombre</label>
                <input type="radio" name="sexo" id="man" value="man" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "man") echo "checked" ?>>
                <label for="woman">Mujer</label>
                <input type="radio" name="sexo" id="woman" value="woman" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "woman") echo "checked" ?>>
                <?php
                if (isset($_POST["send"]) && $err_sex) {
                    echo "<span class = 'error'>*Campo Obligatorio*</span>";
                }
                ?>
            </p>

            <p>
                Aficiones:
                <label for="sport">Deportes</label>
                <input type="checkbox" name="hobby" id="sport">
                <label for="read">Lectura</label>
                <input type="checkbox" name="hobby" id="read">
                <label for="other">Otros</label>
                <input type="checkbox" name="hobby" id="other">
            </p>

            <p>
                <label for="comment">Comentarios:</label>
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            </p>

            <p>
                <input type="submit" value="Enviar" name="send">
            </p>
        </form>
    </body>

    </html>

<?php
}
?>