<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $estadios_futbol = array("Barcelona" => "Camp Nou", "Real Madrid" => "Santiago Bernabeu", "Valencia" => "Mestalla", "Real Sociedad" => "Anoeta");
    echo "<table border = '1'>";
    echo "<tr>";
    echo "<td>index</td>";
    echo "<td>value</td>";
    echo "</tr>";

    foreach ($estadios_futbol as $i => $value) {
        echo "<tr>";
        echo "<td>";
        echo "$i";
        echo "</td>";
        echo "<td>";
        echo "$value";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<br><br>";

    $estadios_futbol["Real Madrid"] = "_";
    echo "<ol>";
    foreach ($estadios_futbol as $i => $value) {
        echo "<li>";
        echo "Index: $i; ";
        echo "Value: $value";
        echo "</li>";
    }
    echo "</ol>";
    ?>
</body>

</html>