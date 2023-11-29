<?php
require("functions.php");
session_start();

if (isset($_SESSION["message"])) {
    echo $_SESSION["message"];
    unset($_SESSION["message"]);
}
if (isset($_POST["del"])) {
    deleteFilm($_POST["del"]);
    echo "eliminado con exito";
    session_destroy();
    session_start();
    $_SESSION["message"] = "delete film";
    header("Location: index.php");
    exit;
}
if (isset($_POST["back"])) {
    echo $_SESSION["id"];
    $_POST["edit"] = $_SESSION["id"];
}
if (isset($_POST["delPhotoFin"])) {
    try {
        $conn = mysqli_connect(BD_SERVER, USER, PASS, BD_NAME);
    } catch (Exception $e) {
        echo "no se puede conectar a BD";
        mysqli_close($conn);
    }
    try {
        $result = mysqli_query($conn, "update peliculas set caratula='no_imagen.jpg' where idPelicula=" . $_SESSION['id'] . "");
    } catch (Exception $e) {
        echo "no se puede proceder query a BD";
        mysqli_close($conn);
    }
    session_destroy();
    session_start();
    $_SESSION["message"] = "delete picture";
    header("Location: index.php");
    exit;
}
if (isset($_POST["home"])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
if (isset($_POST["saveChanges"])) {
    $changes = false;
    // $_SESSION["titulo"] = $titulo;
    // $_SESSION["director"] = $director;
    // $_SESSION["tematica"] = $tema;
    // $_SESSION["sinopsis"] = $description;
    // $_SESSION["caratula"] = $photo;
    if ($_POST["titulo"] != $_SESSION["titulo"]) {
        $changes = true;
        change($_SESSION["id"], "titulo", $_POST["titulo"]);
    }
    if ($_POST["director"] != $_SESSION["director"]) {
        $changes = true;
        change($_SESSION["id"], "director", $_POST["director"]);
    }
    if ($_POST["tema"] != $_SESSION["tematica"]) {
        $changes = true;
        change($_SESSION["id"], "tematica", $_POST["tema"]);
    }
    if ($_POST["description"] != $_SESSION["sinopsis"]) {
        $changes = true;
        change($_SESSION["id"], "sinopsis", $_POST["description"]);
    }
    if ($changes) {
        session_destroy();
        session_start();
        $_SESSION["message"] = "cambios guardados";
    } else {
        session_destroy();
        session_start();
        $_SESSION["message"] = "no hay nada para cambiar";
    }
    header("Location: index.php");
    exit;
}
function getAllFilms()
{
    try {
        $conn = mysqli_connect(BD_SERVER, USER, PASS, BD_NAME);
    } catch (Exception $e) {
        echo "no se puede conectar a BD";
        mysqli_close($conn);
    }
    try {
        $result = mysqli_query($conn, "select * from peliculas");
    } catch (Exception $e) {
        echo "no se puede proceder query a BD";
        mysqli_close($conn);
    }
    return $result;
}
function deleteFilm($id)
{
    try {
        $conn = mysqli_connect(BD_SERVER, USER, PASS, BD_NAME);
    } catch (Exception $e) {
        echo "no se puede conectar a BD";
        mysqli_close($conn);
    }
    try {
        $result = mysqli_query($conn, "delete from peliculas where idPelicula=$id");
    } catch (Exception $e) {
        echo "no se puede proceder query a BD";
        mysqli_close($conn);
    }
    return $result;
}
function getInfo($id)
{
    try {
        $conn = mysqli_connect(BD_SERVER, USER, PASS, BD_NAME);
    } catch (Exception $e) {
        echo "no se puede conectar a BD";
        mysqli_close($conn);
    }
    try {
        $result = mysqli_query($conn, "select * from peliculas where idPelicula=$id");
    } catch (Exception $e) {
        echo "no se puede proceder query a BD";
        mysqli_close($conn);
    }
    return $result;
}
function change($id, $key, $value)
{
    try {
        $conn = mysqli_connect(BD_SERVER, USER, PASS, BD_NAME);
    } catch (Exception $e) {
        echo "no se puede conectar a BD";
        mysqli_close($conn);
    }
    try {
        $result = mysqli_query($conn, "update peliculas set $key=$value where idPelicula=$id");
    } catch (Exception $e) {
        echo "no se puede proceder query a BD";
        mysqli_close($conn);
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prac 9</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    table th {
        background-color: lightgrey;
    }

    button a {
        color: black;
        text-decoration: none;
    }

    button a:visited {
        color: black;
    }

    img {
        width: 100px;
    }
</style>

<body>
    <table border="1">
        <tr>
            <th>id</th>
            <th>Titulo</th>
            <th>Caratula</th>
            <th><a href="#">Peliculas +</a></th>
        </tr>
        <?php
        $films = getAllFilms();
        while ($line = mysqli_fetch_assoc($films)) {
            echo "<tr>";
            foreach ($line as $key => $value) {
                if ($key == "idPelicula") {
                    echo "<td>$value</td>";
                } elseif ($key == "titulo") {
                    echo "<td><a href='views/show.php?id=" . $line["idPelicula"] . "'>$value</a></td>";
                } elseif ($key == "caratula") {
                    echo "<td>$value</td>";
                }
            }
            echo "<td>";
            echo '<form action="index.php" method="post"><button type="submit" name="del" value="' . $line["idPelicula"] . '">Borrar</button> - ';
            echo '<button type="submit" name="edit" value="' . $line["idPelicula"] . '">Editar</button></form>';
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php

    // чтобы заработало, нужно убрать a href из кнопки
    if (isset($_POST["edit"]) || (isset($_SESSION["id"]) && !isset($_POST["delPhoto"]))) {
    ?>
        <h1>Editar una pelicula</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <?php
            if (isset($_SESSION["id"])) {
                $films = mysqli_fetch_assoc(getInfo($_SESSION["id"]));
            } else {
                $films = mysqli_fetch_assoc(getInfo($_POST["edit"]));
                $_SESSION["id"] = $_POST["edit"];
            }
            $titulo = $films["titulo"];
            $director = $films["director"];
            $tema = $films["tematica"];
            $photo = $films["caratula"];
            $description = $films["sinopsis"];
            //save variables
            $_SESSION["titulo"] = $titulo;
            $_SESSION["director"] = $director;
            $_SESSION["tematica"] = $tema;
            $_SESSION["caratula"] = $photo;
            $_SESSION["sinopsis"] = $description;
            ?>
            <p>Titulo de la pelicula<br><input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>"></p>
            <p>Director de la pelicula<br><input type="text" name="director" id="director" value="<?php echo $director ?>"></p>
            <p>Tematica de la pelicula<br><input type="text" name="tema" id="tema" value="<?php echo $tema ?>"></p>
            <p>Caratula Actual <br><img src="img/<?php echo $photo ?>" alt="image"><br><button type="submit" value="<?php echo $_SESSION["caratula"] ?>" name="delPhoto">Eliminar Caratula</button></p>
            <p>Sinopsis de la pelicula</p>
            <textarea name="description" id="description" cols="30" rows="10"><?php echo $description ?></textarea><br>
            <p>Cambiar caratula de la pelicula:<input type="file" name="photo" id="photo"></p>
            <input type="submit" value="Editar pelicula" name="saveChanges">
            <button type="submit" value="<?php echo $_SESSION["id"] ?>" name="home">Atras</button>
            <br>
        </form>
    <?php
    }
    if (isset($_POST["delPhoto"])) {
        echo "se dispone a cambiar la carratula <img src='img/" . $_POST["delPhoto"] . "' alt='old picture'> por esta otra: <img src='img/no_imagen.jpg' alt='new picture'>";
        echo "<form action='index.php' method='post'>";
        echo '<br>';
        echo '<button type="submit" value = "' . $_SESSION["id"] . '" name="delPhotoFin">Continuar</button>';
        echo '<button type="submit" value = "' . $_SESSION["id"] . '" name="backPhoto">Atras</button>';
        // echo '<input type="submit" value="Atras" name="back">';
        echo "</form>";
    }
    ?>
</body>


</html>