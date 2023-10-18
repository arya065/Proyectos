<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // $arr1["Simpsons"] = ["Padre"];
    $arr1["Simpsons"]["Padre"] = "Homer";
    // $arr1["Simpsons"] = ["Madre"];
    $arr1["Simpsons"]["Madre"] = "Marge";
    // $arr1["Simpsons"] = ["Hijos"];
    $arr1["Simpsons"]["Hijos"] = "Bart";
    $arr1["Simpsons"]["Hijos"] = "Lisa";
    $arr1["Simpsons"]["Hijos"] = "Maggie";

    // $arr1["Griffins"] = ["Padre"];
    $arr1["Griffins"]["Padre"] = "Peter";
    // $arr1["Griffins"] = ["Madre"];
    $arr1["Griffins"]["Madre"] = "Lois";
    // $arr1["Griffins"] = ["Hijos"];
    $arr1["Griffins"]["Hijos"] = "Chris";
    $arr1["Griffins"]["Hijos"] = "Meg";
    $arr1["Griffins"]["Hijos"] = "Stewie";

    print_r($arr1);

    echo "<ul'>";
    foreach ($arr1 as $i => $container) {
        echo "<li>" . $i . "<ul>";
        foreach ($container as $j => $value) {
            echo "<li> $value </li>";
        }
        echo "</ul></li>";
    }
    echo "</ul>";
    ?>
</body>

</html>