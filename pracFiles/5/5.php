<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej5</title>
</head>

<body>
    <form action="5.php" method="post" enctype="multipart/form-data">
        <input type="submit" value="send" name="send">
    </form>

    <?php
    if (isset($_POST["send"])) {
        @$fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
        // echo fpassthru($fd);
    ?>
        <table border="1">
            <?php
            while (!feof($fd)) {
                $string = fgets($fd);
                $values = explode("\t", $string);
                echo "<tr>";
                for ($i = 0; $i < count($values); $i++) {
                    echo "<th>";
                    echo $values[$i];
                    echo "</th>";
                }
                if (count($values) < 21) {
                    $columns_to_fill = 21 - count($values);
                    for ($i = 0; $i < $columns_to_fill; $i++) {
                        echo "<th>";
                        echo " ";
                        echo "</th>";
                    }
                }
                echo "</tr>";
            }
            ?>
        </table>
    <?php
    }
    ?>
</body>

</html>