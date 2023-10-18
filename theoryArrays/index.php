<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>

<body>
    <?php
    //first
    $arr1[0] = 1;
    $arr1[1] = "text";
    $arr1[2] = 3.0;
    $arr1[3] = true;
    $arr1[4] = 5;
    print_r($arr1);
    echo "<br>";
    var_dump($arr1);

    //ставит на следующую не заполненную
    $arr1[] = "test1";
    $arr1[] = "test2";
    $arr1[] = "test3";
    var_dump($arr1);

    //for normal array
    echo "recorrido de un array escalar con sus indices correlativos";
    for ($i = 0; $i < count($arr1); $i++) {
        echo "<p>Position $i : $arr1[$i]</p>";
    }

    //if array is empty somewhere
    echo "recorrido de un array escalar con sus indeces NO correlativos";
    foreach ($arr1 as $i => $container) {
        echo "<p>Value at index $i: $container</p>";
    }

    //second
    $arr2 = array(1, true, "text", 2.53);
    print_r($arr2);
    echo "<br>";

    //third
    $arr3["test1"]["another1"] = 1;
    $arr3["test2"]["another2"] = 2;
    $arr3["test3"]["another3"] = 3;
    $arr3["test4"]["another4"] = 4;
    foreach ($arr3 as $i => $container) {
        echo "<p>Index $i :</p>";
        foreach ($container as $j => $value) {
            echo "<p>$value</p>";
        }
    }

    //last value of array
    echo "<p>Ultimo de un array " . end($arr2) . "</p>";
    echo "<p>Ultimo de un array " . current($arr2) . "</p>";
    echo "<p>Ultimo de un array " . key($arr2) . "</p>";
    reset($arr2);
    next($arr2);
    is_array($arr2);



    ?>
</body>

</html>