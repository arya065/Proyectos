<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr[] = 1;
    $arr[] = 2;
    $arr[] = 3;
    $arr[] = 4;
    $arr[] = 5;
    $arr[] = 6;
    $arr[] = 7;
    $arr[] = 8;
    $arr[] = 9;
    $arr[] = 10;

    $sum = 0;

    for ($i = 0; $i < count($arr); $i += 2) {
        $sum += $arr[$i];
        echo  "<p>$arr[$i]</p>";
    }
    echo "<p>Sum: $sum</p>";
    ?>
</body>

</html>