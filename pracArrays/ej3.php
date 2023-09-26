<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr1[12] = "peli2";
    $arr1[0] = "peli1";
    $arr1[17] = "peli3";
    $arr1[9] = "";
    foreach ($arr1 as $i => $value) {
        echo "<strong>Mes $i:</strong>";
        if ($value != null) {
            echo "<p>$value<span>; </span></p>";
        } else {
            echo "no hay peliculas";
        }
    }
    ?>
</body>

</html>