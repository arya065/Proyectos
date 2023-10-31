<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria BD</title>
</head>

<body>
    <?php
    try {
        $conn = mysqli_connect("localhost", "jose", "josefa", "bd_teoria");
        mysqli_set_charset($conn, "utf-8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "select * from t_alumnos";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido crear consulta:" . $e->getMessage() . "</p></body></html>");
    }

    $n_tuplas = mysqli_num_rows($result);
    echo "<p>El numero de tuplas ha sido: " . $n_tuplas . "</p>";
    $tupla = mysqli_fetch_assoc($result); //вытаскиевает данные из таблицы и нумерует в имена колонны
    echo "<p>Primer alumno obtenido tiene nombre:" . $tupla["nombre"] . " </p>";

    $tupla2 =  mysqli_fetch_row($result); //вытаскиевает данные из таблицы и нумерует в индексы колонны

    $tupla3 = mysqli_fetch_array($result); //выатскивает данные из таблицы и нумерует и в том, и в другом виде

    $tupla4 = mysqli_fetch_object($result);

    mysqli_data_seek($result, 0); //перемещает каретку на заданную строчку

    echo "<table border='1'>";
    echo "<tr><th>Codigo</th><th>Nombre</th><th>Telefono</th><th>Codigo postal</th></tr>";
    while ($tupla = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $tupla["cod_alu"] . "</td>";
        echo "<td>" . $tupla["nombre"] . "</td>";
        echo "<td>" . $tupla["telefono"] . "</td>";
        echo "<td>" . $tupla["cp"] . "</td>";

        echo "</tr>";
    }
    echo "</table>";
    
    mysqli_free_result($result);



    mysqli_close($conn);
    ?>
</body>

</html>