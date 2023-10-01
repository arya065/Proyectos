<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $lenguajes_cliente[1]["uno"] = "valor1";
    $lenguajes_cliente[2]["dos"] = "valor2";
    $lenguajes_cliente[3]["tres"] = "valor3";
    $lenguajes_servidor[1]["unoServ"] = "valor1Serv";
    $lenguajes_servidor[2]["dosServ"] = "valor2Serv";
    $lenguajes_servidor[3]["tresServ"] = "valor3Serv";
    $lenguajes[] = array_merge($lenguajes_cliente, $lenguajes_servidor);
    ?>
    <table border="1">
        <caption>Result:</caption>
        <?php
        echo "<tr>";
        echo "<td>";
        echo "<p>index lenguajes</p>";
        echo "</td>";
        echo "<td>";
        echo "<p>index1</p>";
        echo "</td>";
        echo "<td>";
        echo "<p>index2</p>";
        echo "</td>";
        echo "<td>";
        echo "<p>value</p>";
        echo "</td>";
        echo "</tr>";

        foreach ($lenguajes as $i => $container) {
            foreach ($container as $j => $container2) {
                echo "<tr>";
                foreach ($container2 as $k => $value) {
                    echo "<td>";
                    echo "<p>$i</p>";
                    echo "</td>";
                    echo "<td>";
                    echo "<p>$j</p>";
                    echo "</td>";
                    echo "<td>";
                    echo "<p>$k</p>";
                    echo "</td>";
                    echo "<td>";
                    echo "<p>$value</p>";
                    echo "</td>";
                }
                echo "</tr>";
            }
        }
        // print_r($lenguajes);
        ?>
    </table>
</body>

</html>