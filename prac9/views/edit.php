<?php
require("../functions.php");
session_start();


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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<style>
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
    <h1>Editar una pelicula</h1>
    <form action="../index.php" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_SESSION["id"])) {
            $films = mysqli_fetch_assoc(getInfo($_SESSION["id"]));
        } else {
            $films = mysqli_fetch_assoc(getInfo($_GET["id"]));
            $_SESSION["id"] = $_GET["id"];
        }
        $titulo = $films["titulo"];
        $director = $films["director"];
        $tema = $films["tematica"];
        $description = $films["sinopsis"];
        $photo = $films["caratula"];
        //save variables
        $_SESSION["titulo"] = $titulo;
        $_SESSION["director"] = $director;
        $_SESSION["tematica"] = $tema;
        $_SESSION["sinopsis"] = $description;
        $_SESSION["caratula"] = $photo;
        ?>
        <p>Titulo de la pelicula<br><input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>"></p>
        <p>Director de la pelicula<br><input type="text" name="director" id="director" value="<?php echo $director ?>"></p>
        <p>Tematica de la pelicula<br><input type="text" name="tema" id="tema" value="<?php echo $tema ?>"></p>
        <p>Caratula Actual <br><img src="../img/<?php echo $photo ?>" alt="image"><br><button type="submit" value="<?php echo $_SESSION["caratula"] ?>" name="delPhoto">Eliminar Caratula</button></p>
        <p>Sinopsis de la pelicula</p>
        <textarea name="description" id="description" cols="30" rows="10"><?php echo $description ?></textarea><br>
        <p>Cambiar caratula de la pelicula:<input type="file" name="photo" id="photo"></p>
        <input type="submit" value="Editar pelicula" name="send">
        <button><a href="../index.php">Atras</a></button>
        <br>
    </form>
</body>

</html>