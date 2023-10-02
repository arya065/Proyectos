<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $str1 = "   Hola";
    $str2 = "Juan";

    echo "<h1>$str1 $str2</h1>";

    //length fo string
    $longitud = strlen($str1);
    echo "" . $longitud . "<br>";

    //chars at string with index
    $a = $str1[3];
    echo "$a <br>";
    $str1[0] = "J";

    echo strtoupper($str2);
    echo "" . strtolower($str2) . "<br>";

    $str3 = trim($str1);
    echo "" . strlen($str3) . "<br>";

    //separator of arrays, but work with strings
    $test = "afasdfasdfasdf:fin";
    $separate = explode(":", $test);
    echo "" . end($separate) . "<br>";

    //separate elements with all what u want
    $arr = array("test", "test2", "test3");
    $str4 = implode(":::", $arr);
    echo "$str4 <br>";


    //from the index 3, take 5 simbols
    echo "<p>" . substr("hola juand", 3, 5) . "</p>";
    //можно поставить только начальный индекс, тогда возьмётся вся оставшаяся строка




    ?>
</body>

</html>