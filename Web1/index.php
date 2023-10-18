<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Teoria elemental de PHP 
        <?php echo date ("d-m-Y");?>
    </h1>

    <!-- объявление PHP -->
    <?php

        // объявление постоянной
        define("PI",3.1415);

        // выполнить код (выполняется HTML)
        echo "<span>test php</span>";
        // объявление переменных
        $var=PI;
        $var2=9;
        $var3= $var+$var2;
        // вывод переменных вместе с кодом HTML
        echo "<p>Resultado "  .$var. "+" .$var2. " es " .$var3. "</p>";

        // объявление if
        if($var > $var2 && $var > $var2 || $var > $var2)
        {
            echo "<p>var es mas grande</p>";
        } elseif ($var==$var2)
        {
            echo "<p>var2 es igual a var</p>";
        }
        else
        {
            echo "<p>var2 es mas grande</p>";
        }

        // объявление switch
        switch($var3 < 10){
            case 1: $var3 = $var+$var2; break;
            case 2: $var3 = $var-$var2; break;
            case 3: $var3 = $var*$var2; break;

            default:$var3=$var/$var2;break;
        }
        echo "<p>result is  $var3 </p>";

        // циклы for, while
        echo "<b>Цикл for</b>";
        for($i=0;$i < 5; $i++){
            echo "<p>HelloWorld - " .($i+1). "</p>";
        }

        echo "<b>Цикл while</b>";
        $i=0;
        while ($i < 5)
        {
            echo "<p>HelloWorld - " .($i+1). "</p>";
            $i++;
        }
    ?>
    
</body>
</html>