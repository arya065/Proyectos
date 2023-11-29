<?php
require("functions.php");
if (isset($_POST["del"])) {
    deleteFilm($_POST["del"]);
    echo "eliminado con exito";
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
            echo '<button type="submit" name="edit" value="' . $line["idPelicula"] . '"><a href="views/edit.php?id=' . $line["idPelicula"] . '">Editar</a></button></form>';
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_POST["delPhoto"])) {
        echo "se dispone a cambiar la carratula <img src='img/" . $_POST["delPhoto"] . "' alt='old picture'> por esta otra: <img src='img/no_imagen.jpg' alt='new picture'>";
        echo "<form action='index.php' method='post'>";
        echo '<br>';
        echo '<input type="submit" value="Continuar" name ="send">';
        echo '<button><a href="views/edit.php">Atras</a></button>';
        echo "</form>";
    }
    ?>
</body>

</html>