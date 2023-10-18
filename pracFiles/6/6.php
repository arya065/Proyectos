<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej6</title>
</head>

<body>
    <form action="6.php" method="post" enctype="multipart/form-data">
        <label for="counry">Seleciona un pais:</label>
        <select name="country" id="country">
            <option value="AT">AT</option>
            <option value="BE">Belgia</option>
            <option value="BG">Bolgaria</option>
            <option value="CH">Switherland</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Chequia</option>
            <option value="DE">Alemania</option>
            <option value="DK">Denmark</option>
            <option value="19">EA19</option>
            <option value="EE">Estonia</option>
            <option value="EL">Belarusia</option>
            <option value="ES">Espana</option>
            <option value="20">EU27</option>
            <option value="28">EU28</option>
            <option value="FI">Finlandia</option>
            <option value="FR">Francia</option>
            <option value="HR">Croatia</option>
            <option value="HU">Hungary</option>
            <option value="IE">Ireland</option>
            <option value="IS">Iceland</option>
            <option value="IT">Italia</option>
            <option value="LT">Lithuania</option>
        </select>
        <input type="submit" value="send" name="send">
    </form>

    <?php
    if (isset($_POST["send"])) {
        @$fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
    ?>
        <table border="1">
            <?php
            $first = explode("\t", fgets($fd));
            while (!feof($fd)) {
                $string = fgets($fd);
                $values = explode("\t", $string);
                if (substr($values[0], strlen($values[0]) - 2) == $_POST["country"]) {
                    echo "<tr>";
                    for ($i = 0; $i < count($first); $i++) {
                        echo "<th>";
                        echo $first[$i];
                        echo "</th>";
                    }
                    echo "</tr>";

                    echo "<tr>";
                    for ($i = 0; $i < count($values); $i++) {
                        echo "<th>";
                        echo $values[$i];
                        echo "</th>";
                    }
                    echo "</tr>";
                    break;
                }

                if (count($values) < 21) {
                    $columns_to_fill = 21 - count($values);
                    for ($i = 0; $i < $columns_to_fill; $i++) {
                        echo "<th>";
                        echo " ";
                        echo "</th>";
                    }
                }
            }
            ?>
        </table>
    <?php
        fclose($fd);
    }
    ?>
</body>

</html>