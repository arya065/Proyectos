<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr["MD"] = "Madrid";
    $arr["BR"] = "Barcelona";
    $arr["LO"] = "Londres";
    $arr["NY"] = "New York";
    $arr["LA"] = "Los Angeles";
    $arr["CH"] = "Chicago";
    foreach ($arr as $i => $container){
        echo "<p>Indice: $i </p>";
        echo "Value: $container <br>";
    }
    ?>
</body>

</html>