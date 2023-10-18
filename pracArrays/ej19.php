<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr1["Madrid"]["Nombre"] = "Pedro";
    $arr1["Madrid"]["Edad"] = 32;
    $arr1["Madrid"]["tel"] = "91-999.99.99";

    $arr1["Barcelona"]["Nombre"] = "Susana";
    $arr1["Barcelona"]["Edad"] = 34;
    $arr1["Barcelona"]["tel"] = "93-000.00.00";

    $arr1["Toledo"]["Nombre"] = "Sonia";
    $arr1["Toledo"]["Edad"] = 42;
    $arr1["Toledo"]["tel"] = "925-09.09.0";


    echo "<table border = '1'>";
    echo "<caption>Amigos</caption>";
    echo "<tr>";
    echo "<td>Ciudad</td>";
    echo "<td>Nombre</td>";
    echo "<td>Edad</td>";
    echo "<td>Telefono</td>";
    echo "</tr>";

    echo "<tr>";
    foreach ($arr1 as $i => $container) {
        echo "<tr>";
        echo "<td> $i </td>";
        foreach ($container as $j => $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</tr>";
    echo "</table>";
    ?>
</body>

</html>