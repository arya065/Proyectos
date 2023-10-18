<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr1 = array(5 => 1, 12 => 2, 13 => 56, "x" => 42);

    echo "<table border = '1'>";
    foreach ($arr1 as $i => $value) {
        echo "<tr>";
        echo "<td> $i </td>";
        echo "<td> $value </td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<p>count = ";
    echo "" . count($arr1) . "</p>";

    //delete i = 5
    unset($arr1[array_search(1, $arr1)]);
    //show
    echo "<table border = '1'>";
    foreach ($arr1 as $i => $value) {
        echo "<tr>";
        echo "<td> $i </td>";
        echo "<td> $value </td>";
        echo "</tr>";
    }
    echo "</table>";
    //delete arr
    unset($arr1);
    ?>
</body>

</html>