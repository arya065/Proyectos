<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr1[] = "lagartija";
    $arr1[] = "arana";
    $arr1[] = "perro";
    $arr1[] = "gato";
    $arr1[] = "raton";

    $arr2[] = 12;
    $arr2[] = 34;
    $arr2[] = 45;
    $arr2[] = 52;
    $arr2[] = 12;

    $arr3[] = "sauce";
    $arr3[] = "pino";
    $arr3[] = "naranjo";
    $arr3[] = "chopo";
    $arr3[] = "perro";
    $arr3[] = 34;

    $arr_fin = array_merge($arr1, $arr2, $arr3);



    foreach ($arr_fin as $i => $value){
        echo "<p>Index: $i;";
        echo " Value: $value</p>";
    }
    ?>
</body>

</html>