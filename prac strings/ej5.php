<?php
if (isset($_POST["compare"])) {
    $_POST["first"] = str_replace(" ", "", $_POST["first"]);
    $error_string = !onlyArabian($_POST["first"]);
    $error_form = ($_POST["first"] == "");
}
function transformToRomanianNum($letters)
{
    $letters = (int)$letters;
    $arr = ["|" => 1, "V" => 5, "X" => 10, "L" => 50, "C" => 100, "D" => 500, "M" => 1000];
    $num = "";
    foreach (array_reverse($arr) as $index => $value) {
        do {
            if ($letters / $value >= 1) {
                $variable = (int)($letters / $value);
                for ($i = 0; $i < $variable; $i++) {
                    $num .= $index;
                }
                $letters -= $value * $variable;
            } else {
                break;
            }
        } while (true);
    }

    return $num;
}
function onlyArabian($letters)
{
    $arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

    for ($i = 0; $i < strlen($letters); $i++) {
        if (!isset($arr[$letters[$i]])) {
            return false;
        };
    }
    $num = (int)$letters;
    if ($num >= 5000) {
        return false;
    }
    return true;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .form {
        background-color: lightblue;
        padding: 5px;
        border: solid black 1px;
    }

    .results {
        background-color: lightgreen;
        padding: 5px;
        border: solid black 1px;
        margin-top: 10px;
    }

    h1 {
        text-align: center;
    }

    span {
        color: red;
    }
</style>

<body>
    <div class="form">
        <h1>Romanos a arabes -Formulario</h1>
        <form action="ej5.php" method="post">
            <p>Dime un numero en numeros romanos y lo conviertire a cifras arabes</p>
            <p>
                <label for="first">Numero: </label>
                <input type="text" id="first" name="first" value="<?php if (isset($_POST["first"])) echo $_POST["first"] ?>">
                <?php
                if (isset($_POST["compare"])) {
                    $_POST["first"] = trim($_POST["first"]);
                    if ($error_form) {
                ?>
                        <span>*Campo Vacio*</span>
                    <?php
                    }
                    if ($error_string) {
                    ?>
                        <span>*Letras Invalidas*</span>
                <?php
                    }
                }
                ?>
            </p>
            <input type="submit" value="Comparar" name="compare">
        </form>
    </div>

    <?php
    if (isset($_POST["compare"]) && !$error_form && !$error_string) {
    ?>
        <div class="results">
            <h1>Romanos a arabes -Resultado</h1>
            <?php
            echo "El numero ", $_POST["first"], " se escribe en cifras arabes ", transformToRomanianNum($_POST["first"]);
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>