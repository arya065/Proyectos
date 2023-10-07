<!-- умножаем число последовательно на каждую букву и складываем -->
<!-- quitar espacios -->
<?php
if (isset($_POST["compare"])) {
    $_POST["first"] = str_replace(" ", "", $_POST["first"]);
    $error_string = !onlyRomanians($_POST["first"]) || !RomaniansCorrect($_POST["first"]);
    $error_form = ($_POST["first"] == "");
}
function transformToArabianNum($letters)
{
    $arr = ["|" => 1, "V" => 5, "X" => 10, "L" => 50, "C" => 100, "D" => 500, "M" => 1000];
    $num = 0;
    for ($i = 0; $i < strlen($letters); $i++) {
        $num += $arr[$letters[$i]];
    }
    return $num;
}
function onlyRomanians($letters)
{
    $arr = ["|" => 1, "V" => 5, "X" => 10, "L" => 50, "C" => 100, "D" => 500, "M" => 1000];
    for ($i = 0; $i < strlen($letters); $i++) {
        if (!isset($arr[$letters[$i]])) {
            return false;
        };
    }
    return true;
}
function RomaniansCorrect($letters)
{
    $counter = 1;
    for ($i = 1; $i < strlen($letters); $i++) {
        if ($letters[$i] == $letters[$i - 1]) {
            $counter+=1;
        } else {
            $counter = 0;
        }
        if ($counter > 4) {
            return false;
        }
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
        <form action="ej4.php" method="post">
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
            echo "El numero ", $_POST["first"], " se escribe en cifras arabes ", transformToArabianNum($_POST["first"]);
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>