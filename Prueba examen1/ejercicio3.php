<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $text = ",,,,,1,2,,,,,,,,,,3,4,5,,,6,,,7,8,9,,,,,,,";
    // $arr = explode(",", $text);
    // $arr = array_filter($arr);
    echo mi_explode(",", $text, ",", 0, 0);

    function mi_explode($sep, $text, $now, $count, $i)
    {
        if ($i == strlen($text) - 1) {
            if ($now == "," && $text[$i] != ",") {
                return $count + 1;
            } else {
                return $count;
            }
        } else {
            if ($now == ",") {
                if ($text[$i] != ",") {
                    $count = $count + 1;
                    $now = "a";
                }
            } else {
                if ($text[$i] == ",") {
                    $now = ",";
                }
            }
            return mi_explode($sep, $text, $now, $count, $i + 1);
        }
    }
    ?>
</body>

</html>