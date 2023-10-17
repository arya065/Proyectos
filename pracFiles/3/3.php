<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej3</title>
</head>

<body>
    <form action="3.php" method="post">
        <label for="ask">Elige numero de tabla</label>
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
        <br>
        <label for="ask2">Elige numero de linea</label>
        <select name="ask2" id="ask2">
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
        $numero_linea = $_POST["ask2"];
        if (file_exists("Tablas/" . $nombre_fichero)) {
            @$fd = fopen("Tablas/" . $nombre_fichero, "r");
            // fwrite($fd, $_POST["ask"]);
            // readFichero($fd);
            readFicheroLinea(fopen("Tablas/" . $nombre_fichero, "r"),$numero_linea);
        }
    }
    function readFichero($fd)
    {
        while (!feof($fd)) {
            echo fgets($fd), "<br>";
        }
        fclose($fd);
    }
    function readFicheroLinea($fd, $numLine)
    {
        for ($i = 0; $i <= $numLine; $i++){
            if($i == $numLine-1){
                echo fgets($fd), "<br>";
            }
            fgets($fd);
        }

        fclose($fd);
    }
    ?>
</body>

</html>