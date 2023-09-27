<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arr[] = "Pedro";
    $arr[] = "Ismael";
    $arr[] = "Sonia";
    $arr[] = "Clara";
    $arr[] = "Susana";
    $arr[] = "Alfonso";
    $arr[] = "Teresa";

    echo "<p>Contiene: ", count($arr), " elementos</p>";
    echo "<ul>";
    foreach ($arr as $i => $container) {
        echo "<li>", "$container", "</li>";
    }
    echo "</ul>";
    ?>
</body>

</html>