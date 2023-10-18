<?php
if (isset($_POST["compare"])) {
    // $_POST["first"] = str_replace(" ", "", $_POST["first"]);
    $error_string = !correctString($_POST["first"]);
    $error_form = ($_POST["first"] == "");
}
function replace($letters)
{
    $letters = str_replace(",", ".", $letters);
    return $letters;
}
function correctString($letters)
{
    $arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ",", ".", " ", "-"];
    for ($i = 0; $i < strlen($letters); $i++) {
        if (!in_array($letters[$i], $arr)) {
            return false;
        };
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
        <h1>Unifica separador decimal -Formulario</h1>
        <form action="ej7.php" method="post">
            <p>Escribe varios numeros separados por espacios y unificare el separador decimal a puntos</p>
            <p>
                <label for="first">Numeros: </label>
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
            <h1>Unifica separador decimal - Resultado</h1>
            <?php
            echo "<p>Numeros originales</p>";
            echo "<p>", $_POST["first"], "</p>";
            echo "<p>Numeros corregidos</p>";
            echo "<p>", replace($_POST["first"]), "</p>";
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>