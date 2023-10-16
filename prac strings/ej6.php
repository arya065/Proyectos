<!-- ÁÉÍÓÚáéóú -->
<?php
if (isset($_POST["compare"])) {
    $_POST["first"] = str_replace(" ", "", $_POST["first"]);
    $error_form = $_POST["first"] == "";
}
function replace($letters)
{
    $arr = ["á" => "a", "é" =>  "e",  "í" => "i",  "ó" => "o",  "ú" => "u", "Á" => "A", "É" => "E",  "Í" => "I", "Ó" => "O", "Ú" => "U"];
    for ($i = 0; $i < mb_strlen($letters, 'UTF-8'); $i++) {
        $var = mb_substr($letters, $i, 1, 'UTF-8');
        foreach ($arr as $index => $value) {
            if ($var == $index) {
                $letters = str_replace($var, $value, $letters);
            }
        }
    }
    return $letters;
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
        <h1>Quita acentos -Formulario</h1>
        <form action="ej6.php" method="post">
            <p>Escribe un texto y le quitare los acentos</p>
            <p>
                <label for="first">Texto </label>
                <input type="text" id="first" name="first" value="<?php if (isset($_POST["first"])) echo $_POST["first"] ?>">
                <?php
                if (isset($_POST["compare"])) {
                    $_POST["first"] = trim($_POST["first"]);
                    if ($error_form) {
                ?>
                        <span>*Campo Vacio*</span>
                <?php
                    }
                }
                ?>
            </p>
            <input type="submit" value="Comparar" name="compare">
        </form>
    </div>

    <?php
    if (isset($_POST["compare"]) && !$error_form) {
    ?>
        <div class="results">
            <h1>Quita acentos - Resultado</h1>
            <?php
            echo "<p>Texto original</p>";
            echo "<p>", $_POST["first"], "</p>";
            echo "<p>Texto sin acentos</p>";
            echo "<p>", replace($_POST["first"]), "</p>";
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>