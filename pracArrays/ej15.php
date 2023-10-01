<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr1 = array(1 => 3, 2 => 2, 3 => 8, 4 => 123, 5 => 5, 6 => 1);


    sort($arr1);

    echo "<table border = '1'>";
    echo "<tr>";
    foreach ($arr1 as $i => $value) {
        echo "<td> $value </td>";
    }
    echo "</tr>";
    echo "</table>";
    ?>
</body>

</html>