<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $deportes[] = "futbol";
    $deportes[] = "baloncesto";
    $deportes[] = "natacion";
    $deportes[] = "tenis";
    for ($i = 0; $i < count($deportes); $i++) {
        echo "<p>$deportes[$i]</p>";
    }
    echo "<p>Total:" . count($deportes) . "</p>";

    reset($deportes);
    next($deportes);
    echo "current: " . current($deportes) . "<br>";

    echo "last: " . end($deportes) . "<br>";
    echo "previous: " . prev($deportes) . "";
    ?>
</body>

</html>