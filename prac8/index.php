<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 8</title>
    <style>
        table {
            border-collapse: collapse;
        }

        img {
            height: 50px;
            width: 50px;
        }

        a:visited {
            color: blue;
        }
    </style>
</head>

<body>
    <h1>Practica 8</h1>
    <h3>Listado de los usuarios</h3>
    <table border="2">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th><a href="#">Usuario+</a></th><!--при нажатии открывает форму с добавлением пользователя-->
        </tr>
        <?php
        try {
            $conn = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conn, "utf-8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        try {
            $consulta = "select * from usuarios";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
        }
        $num = mysqli_num_rows($result);
        for ($i = 0; $i < $num; $i++) {
            $line = mysqli_fetch_assoc($result);
            echo '<tr>';
            echo '<td>' . $line["id_usuario"] . '</td>';
            echo '<td><img src = "img/' . $line["foto"] . '"alt="Foto usuario"></td>';
            echo '<td><a href="#">' . $line["nombre"] . '</a></td>';
            echo '<td><a href="#">Borrar</a> - <a href="#">Editar</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>