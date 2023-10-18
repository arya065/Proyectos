<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theory Dates</title>
</head>

<body>
    <?php
    echo "<p>", time(), "</p>"; // количество секунд с 1 января 1970
    echo "<p>", date("D/M/Y/h:i:s", 1), "</p>";
    if (checkdate(2, 30, 2023)) {
        echo "correct";
    } else {
        echo "not correct";
    }
    echo "<br>", mktime(1, 1, 2000);
    echo "<br>", strtotime("09/23/1999");

    print floor(6.7);
    print ceil(6.2);
    printf("<p>%.2f</p>", 5.66666666666 * 4.33333333333);
    $test = sprintf("<p>%.2f</p>", 5.66666666666 * 4.33333333333);

    for ($i = 1; $i <= 10; $i++) {
        echo "<p>", sprintf("% 03d", $i), "</p>";
    }

    ?>
</body>

</html>