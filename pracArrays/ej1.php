<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    for ($i = 0; $i <= 9 * 2; $i+=2) {
        $arr[] = $i;
        echo "<p>" . $arr[$i / 2] . "</p>";
    }
    ?>
</body>

</html>