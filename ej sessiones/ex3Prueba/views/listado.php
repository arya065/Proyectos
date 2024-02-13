<?php
require "../function.php";
session_start();
function getAllMovies()
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select idPelicula,titulo,caratula from peliculas";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
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
        }

        th {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <p>
        Bienvenido <?php echo $_SESSION["username"] ?> -
        <a href="../index.php?logout=true">Salir</a>
    </p>
    <h2>Listado</h2>
    <table border="1px">
        <tr>
            <th>id</th>
            <th>Titulo</th>
            <th>Caratula</th>
        </tr>
        <?php
        $list = getAllMovies();
        foreach ($list as $key => $value) {
            echo '<tr>';
            foreach ($value as $param) {
                echo '<td>';
                echo $param;
                echo '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>