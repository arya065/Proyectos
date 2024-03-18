<?php
if (isset ($_POST["send"])) {
    $err = $_POST["usuario"] == "" || $_POST["nombre"] == "" || $_POST["clave"] == "" || $_POST["dni"] == "" || $_POST["sexo"] == "" || $_POST["boletin"] == "";
    $err_foto = ($_FILES["foto"]["size"] > 500 * 1024) || $_FILES["foto"]["name"] == '';
}
if (isset ($_POST["send"]) && !$err && !$err_foto) {
    echo "<h1>DATOS ENVIADOS</h1>";
    echo '<p>Usuario: ' . $_POST["usuario"] . '</p>';
    echo '<p>DNI: ' . $_POST["dni"] . '</p>';
    echo "<hr>";
    echo "<h3>Foto</h3>";
    echo '<p>Nombre:' . $_FILES["foto"]["name"] . '</p>';
    echo '<p>Tipo:' . $_FILES["foto"]["type"] . '</p>';
    echo '<p>Tamano:' . $_FILES["foto"]["size"] . '</p>';
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], "images/" . $_FILES["foto"]["name"])) {
        echo "<p>La imagen movido a la carpeta destino con exito</p>";
        echo '<img src="./images/' . $_FILES["foto"]["name"] . '" alt="imagen">';
    } else {
        echo "<p>Error de mover imagen a la carpeta</p>";
    }
} else {


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form</title>
        <style>
            span::after {
                content: "*";
            }

            span::before {
                content: "*";
            }
        </style>
    </head>

    <body>
        <h1>Rellena tu CV</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div>
                <p>
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" value="<?php if (isset ($_POST["usuario"]))
                        echo $_POST["usuario"] ?>">
                        <?php
                    if (isset ($_POST["usuario"]) && $_POST["usuario"] == "") {
                        echo "<span>Debes rellenar el usuario</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php if (isset ($_POST["nombre"]))
                        echo $_POST["nombre"] ?>">
                        <?php
                    if (isset ($_POST["nombre"]) && $_POST["nombre"] == "") {
                        echo "<span>Debes rellenar el nombre</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="clave">Contrasena</label>
                    <input type="password" name="clave" id="clave">
                    <?php
                    if (isset ($_POST["clave"]) && $_POST["clave"] == "") {
                        echo "<span>Debes rellenar el clave</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" value="<?php if (isset ($_POST["dni"]))
                        echo $_POST["dni"] ?>">
                        <?php
                    if (isset ($_POST["dni"]) && $_POST["dni"] == "") {
                        echo "<span>Debes rellenar el dni</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="hombre">Sexo</label>
                <p>
                    <input type="radio" name="sexo" id="hombre" value="hombre" <?php if (isset ($_POST["sexo"]) && $_POST["sexo"] == "hombre")
                        echo "checked" ?>>
                        <label for="hombre">hombre</label>
                    </p>
                    <p>
                        <input type="radio" name="sexo" id="mujer" value="mujer" <?php if (isset ($_POST["sexo"]) && $_POST["sexo"] == "mujer")
                        echo "checked" ?>>
                        <label for="mujer">mujer</label>
                    </p>
                    <?php
                    if (isset ($_POST["send"]) && $_POST["sexo"] == "") {
                        echo "<span>Debes marcar el sexo</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="foto">Incluir mi foto (Max 500KB)</label>
                    <input type="file" name="foto" id="foto">
                    <?php
                    if ($err_foto) {
                        echo "<span>Foto no correcto</span>";
                    }
                    ?>
                </p>
                <p>
                    <input type="checkbox" name="boletin" id="boletin" <?php if (isset ($_POST["boletin"]))
                        echo "checked" ?>>
                        <label for="boletin">Suscribirme al boletin de novedades</label>
                        <?php
                    if (isset ($_POST["send"]) && $_POST["boletin"] == "") {
                        echo "<span>Debes marcar el boletin</span>";
                    }
                    ?>
                </p>
                <p>
                    <button type="submit" name="send" value="send">Guardar cambios</button>
                    <button type="submit" name="del" value="del">Borrar los datos introducidos</button>
                </p>
            </div>
        </form>
    </body>

    </html>
    <?php
}
?>