<?php
require("../function.php");
session_start();
$conn = createConn();

if (!timeout() && stillExist($_SESSION["usuario"], $conn) && !$_SESSION["usuarioNormal"]) {
    if (isset($_SESSION["message"])) {
        echo $_SESSION["message"];
        unset($_SESSION["message"]);
    }

    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: ../index.php");
        return;
    }
    if (isset($_POST["del"])) {
        // del($_POST["del"]);
        // echo "Eliminado con exito";
        $_SESSION["message"] = "Eliminado con exito";
        header("Location:gest_libros.php");
        return;
    } else if (isset($_POST["edit"])) {
        // echo "Editando con exito";
        $_SESSION["message"] = 'Editando con exito';
        header("Location:gest_libros.php");
        return;
    } else if (isset($_POST["send"])) {
        $errRef = $errTitulo = $errAutor = $errDesc = $errPrecio = false;
        $errFile = false;
        // empty
        if ($_POST["referencia"] == "") {
            $errRef = true;
        }
        if ($_POST["titulo"] == "") {
            $errTitulo = true;
        }
        if ($_POST["autor"] == "") {
            $errAutor = true;
        }
        if ($_POST["desc"] == "") {
            $errDesc = true;
        }
        if ($_POST["precio"] == "") {
            $errPrecio = true;
        }
        // file
        // other
        if (correctNum($_POST["referencia"])) {
            if (repeatRef($_POST["referencia"], $conn)) {
                $errRef = true;
            }
        } else {
            $errRef = true;
        }
        if (!correctNum($_POST["precio"])) {
            $errPrecio = true;
        }
        $errForm =  $errRef || $errTitulo || $errAutor || $errDesc || $errPrecio;
        if (!$errForm) {
            addBook($_POST["referencia"], $_POST["titulo"], $_POST["autor"], $_POST["desc"], $_POST["precio"], $conn);
            $_SESSION["message"] = "anadido con exito";
            header("Location: gest_libros.php");
            return;
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
            table {
                border-collapse: collapse;
                width: 80%;
                margin: auto;
            }

            th {
                background-color: lightgrey;
                text-align: center;
            }

            td {
                text-align: center;
            }

            span {
                color: red;
            }
        </style>
    </head>

    <body>
        <form action="gest_libros.php" method="post">
            <h1>Libreria</h1>
            <?php
            echo '<p>Bienvenido <b>' . $_SESSION["usuario"] . '</b> - <button type="submit" name="logout">Salir</button></p>';
            $list = getAllBooks($conn);
            echo '<table border="1">';
            echo '<tr><th>Ref</th><th>Titulo</th><th>Accion</th></tr>';
            foreach($list as $line){
                echo '<tr>';
                echo '<td>' . $line["referencia"] . '</td>';
                echo '<td>' . $line["titulo"] . '</td>';
                echo '<td><button type="submit" name="del" value="' . $line["referencia"] . '">Borrar</button>-<button type="submit"name="edit" value="' . $line["referencia"] . '">Editar</button></td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
            <h2>Agregar un nuevo libro</h2>
            <p><label for="referencia">Referencia:</label><input type="text" name="referencia" id="referencia" value="<?php if (isset($_POST["send"])) echo $_POST["referencia"] ?>"></p>
            <?php
            if (isset($errRef) && $errRef) {
                echo '<span>*Error de referencia*</span>';
            }
            ?>
            <p><label for="titulo">Titulo:</label><input type="text" name="titulo" id="titulo" value="<?php if (isset($_POST["send"])) echo $_POST["titulo"] ?>"></p>
            <?php
            if (isset($errTitulo) && $errTitulo) {
                echo '<span>*Error de titulo*</span>';
            }
            ?>
            <p><label for="autor">Autor:</label><input type="text" name="autor" id="autor" value="<?php if (isset($_POST["send"])) echo $_POST["autor"] ?>"></p>

            <?php
            if (isset($errAutor) && $errAutor) {
                echo '<span>*Error de Autor*</span>';
            }
            ?>
            <p><label for="desc">Descripcion:</label><input type="text" name="desc" id="desc" value="<?php if (isset($_POST["send"])) echo $_POST["desc"] ?>"></p>
            <?php
            if (isset($errDesc) && $errDesc) {
                echo '<span>*Error de Descipcion*</span>';
            }
            ?>
            <p><label for="precio">Precio:</label><input type="text" name="precio" id="precio" value="<?php if (isset($_POST["send"])) echo $_POST["precio"] ?>"></p>
            <?php
            if (isset($errPrecio) && $errPrecio) {
                echo '<span>*Error de Precio*</span>';
            }
            ?>
            <p><label for="portada">Portada:</label><input type="file" name="portada" id="portada"></p>
            <?php
            if (isset($errFile) && $errFile) {
                echo '<span>*Error de rFile*</span>';
            }
            ?>
            <button type="submit" name="send">Agregar</button>
        </form>
    </body>

    </html>
<?php
} else {
    session_destroy();
    header("Location: ../index.php");
    return;
}
?>