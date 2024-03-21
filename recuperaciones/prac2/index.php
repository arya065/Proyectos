<?php
if (isset ($_POST["del"])) {
    unset($_POST);
}
function checkAficiones($check)
{
    foreach ($_POST["aficiones"] as $key => $value) {
        if ($value == $check) {
            return true;
        }
    }
    return false;
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
    </style>
</head>

<body>
    <h1>Segundo Formulario</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset ($_POST["nombre"]))
                echo $_POST["nombre"] ?>">
                <?php
            if (isset ($_POST["send"]) && $_POST["nombre"] == "") {
                echo "<span>*campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="nacido">Nacido en:</label>
            <select name="nacido" id="nacido">
                <option value="1" <?php if (isset ($_POST["nacido"]) && $_POST["nacido"] == "1")
                    echo "selected" ?>>Malaga
                    </option>
                    <option value="2" <?php if (isset ($_POST["nacido"]) && $_POST["nacido"] == "2")
                    echo "selected" ?>>Cadiz
                    </option>
                    <option value="3" <?php if (isset ($_POST["nacido"]) && $_POST["nacido"] == "3")
                    echo "selected" ?>>
                        Granada</option>
                </select>
            </p>
            <p>
                <label for="hombre">Sexo:</label>
                <label for="hombre">Hombre</label>
                <input type="radio" name="sexo" id="hombre" value="hombre" <?php if (isset ($_POST["sexo"]) && $_POST["sexo"] == "hombre")
                    echo "checked" ?>>
                <label for="mujer" selected>Mujer</label>
                <input type="radio" name="sexo" id="mujer" value="mujer" <?php if (isset ($_POST["sexo"]) && $_POST["sexo"] == "mujer")
                    echo "checked" ?>>
                <?php
                if (isset ($_POST["send"]) && $_POST["sexo"] == "") {
                    echo "<span>*campo obligatorio*</span>";
                }
                ?>
        </p>
        <p>
            <label for="deportes">Aficiones:</label>
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="deportes" <?php if (isset ($_POST["aficiones"]) && checkAficiones("deportes"))
                echo "checked" ?>>
                <label for="lectura">Lectura</label>
                <input type="checkbox" name="aficiones[]" id="lectura" value="lectura" <?php if (isset ($_POST["aficiones"]) && checkAficiones("lectura"))
                echo "checked" ?>>
                <label for="otros">Otros</label>
                <input type="checkbox" name="aficiones[]" id="otros" value="otros" <?php if (isset ($_POST["aficiones"]) && checkAficiones("otros"))
                echo "checked" ?>>
                <?php
            if (isset ($_POST["send"]) && $_POST["aficiones"] == "") {
                echo "<span>*campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" cols="20" rows="2"><?php if (isset ($_POST["comentarios"]))
                echo $_POST["comentarios"] ?></textarea>
                <?php
            if (isset ($_POST["send"]) && $_POST["comentarios"] == "") {
                echo "<span>*campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="foto">Incluir mi foto (Archivo de tipo imagen Max. 500KB)</label>
            <input type="file" name="foto" id="foto">
            <?php
            if (isset ($_POST["send"]) && $_FILES["foto"] == "") {
                echo "<span>*campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="send" value="send">Enviar</button>
            <button type="submit" name="del" value="del">Borrar Campos</button>
        </p>
    </form>
</body>

</html>