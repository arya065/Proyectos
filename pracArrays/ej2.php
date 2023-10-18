<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr1[0] = 1;
    $arr1[1] = "text";
    $arr1[2] = 3.0;
    $arr1[3] = true;
    $arr1[4] = 5;
    foreach ($arr1 as $value){
        echo "$value<span>; </span>";
    }
    ?>
</body>

</html>