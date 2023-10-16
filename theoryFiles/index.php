<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // r-read w-write a-append
    @$fd = fopen("prueba.txt", "r");
    if (!$fd) {
        die("no se ha podido abrir un fichero prueba.txt");
    } else {
        echo "Por ahora todo en orden <br>";
    }
    echo fgets($fd), "<br>"; //выдаёт линию
    echo fgets($fd), "<br>";
    echo fgets($fd), "<br>";
    fseek($fd, 0); //ставит каретку на какую-то линию
    echo fgets($fd), "<br>";

    echo fgetc($fd); //выдаёт позицию каретки
    fseek($fd, 0);
    echo fgetc($fd), "<br>";

    fwrite($fd, PHP_EOL . "test text");//записывает текст в файл
    // fputs();
    echo fpassthru($fd); //выводит все оставшиеся линии из файла


    fclose($fd);
    ?>
</body>

</html>