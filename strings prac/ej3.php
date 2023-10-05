<!-- quitar espacios -->
<?php
if (isset($_POST["compare"])) {
    $error_first = $_POST["first"] == "";
    $error_form = $error_first;
}


function ifPalindrom($first)
{
    $first = str_replace(" ", "", $first);
    if ($first == strrev($first)) {
        return true;
    }
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
        <h1>Palindromos/capicuas -Formulario</h1>
        <form action="ej3.php" method="post">
            <p>Dime una palabra o un numero y te dire si es un palindromo o un numero capicua.</p>
            <p>
                <label for="first">Palabra o numero: </label>
                <input type="text" id="first" name="first" value="<?php if (isset($_POST["first"])) echo $_POST["first"] ?>">
                <?php
                if (isset($_POST["compare"])) {
                    $_POST["first"] = trim($_POST["first"]);
                    if ($error_first) {
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
            <h1>Palindromos/capicuas - Resultado</h1>
            <?php
            if (ifPalindrom($_POST["first"])) {
                echo $_POST["first"], " es palindromo";
            } elseif (!ifPalindrom($_POST["first"])) {
                echo $_POST["first"], " no es palindromo";
            }
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>