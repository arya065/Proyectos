<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr[] = "Madrid";
    $arr[] = "Barcelona";
    $arr[] = "Londres";
    $arr[] = "New York";
    $arr[] = "Los Angeles";
    $arr[] = "Chicago";
    foreach ($arr as $i => $container){
        echo "<p>Indice: $i </p>";
        echo "Value: $container <br>";
    }
    ?>
</body>

</html>