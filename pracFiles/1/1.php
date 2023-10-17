<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej1</title>
</head>

<body>
    <form action="1.php" method="post">
        <label for="ask">Elige un numero</label>
        <select name="ask" id="ask">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <input type="submit" value="Enviar" name="submit">
    </form>
    <?php
    if (isset($_POST["submit"])) {
        $nombre_fichero = "tabla_" . $_POST["ask"] . ".txt";
        if (!file_exists("Tablas/" . $nombre_fichero)) {
            @$fd = fopen("Tablas/" . $nombre_fichero, "w");
            // fwrite($fd, $_POST["ask"]);
            makeMultiplicationTable($fd);
        }
    }
    function makeMultiplicationTable($fd)
    {
        $num = $_POST["ask"];
        for ($i = 1; $i < 11; $i++) {
            $result = $num * $i;
            $string = $num . " * " . $i . " = " . $result .PHP_EOL;
            fwrite($fd, $string);
        }
        fclose($fd);
    }
    ?>
</body>

</html>