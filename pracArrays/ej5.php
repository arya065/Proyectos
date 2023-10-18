<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr["Nombre"]["Pedro Torres"] = 1;
    $arr["Direccion"]["C/ Mayor, 37"] = 2;
    $arr["Telefono"]["123456789"] = 3;



    foreach ($arr as $i => $container) {
        echo "<p>$i : ";
        foreach ($container as $j => $value) {
            echo "$j</p>";
        }
    }
    ?>
</body>

</html>