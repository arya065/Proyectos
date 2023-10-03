<?php
if (isset($_POST["compare"])) {
    $error_first = $_POST["first"] == "";
    $error_form = $error_first || (ifWord($_POST["first"]) && ifNum($_POST["first"]));
    echo "<h1>$error_first</h1>";
}

function ifWord($first)
{
    for ($i = 0; $i <= 9; $i++) {
        for ($j = 0; $j < strlen($first); $j++) {
            if ($first[$j] == $i) {
                return false;
            }
        }
    }
    return true;
}
function ifNum($first)
{
    for ($i = 0; $i <= 9; $i++) {
        for ($j = 0; $j < strlen($first); $j++) {
            $tmp = false;
            if ($first[$j] == $i) {
                $tmp = true;
            }
        }
        if (!$tmp) {
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
        <h1>Palindromos/capicuas -Formulario</h1>
        <form action="ej2.php" method="post">
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
                        // } else if (strlen($_POST["first"]) > 3) {
                        //     $first = substr($_POST["first"], strlen($_POST["first"]) - 3);
                        // } else {
                        //     $first = $_POST["first"];
                        // }
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
            // if (strlen($first) > strlen($second)) {
            //     $first = substr($first, strlen($first) - strlen($second));
            // } else if (strlen($first) < strlen($second)) {
            //     $second = substr($second, strlen($second) - strlen($first));
            // }
            // if (isset($_POST["compare"]) && $first == $second && strlen($first) == 3 && strlen($second) == 3) {
            //     echo "<p>" . $_POST["first"] . " y "  . $_POST["second"] . " se riman</p>";
            // } else if (isset($_POST["compare"]) && $first == $second && strlen($first) == 2 && strlen($second) == 2) {
            //     echo "<p>" . $_POST["first"] . " y "  . $_POST["second"] . " se riman un poco</p>";
            // } else if (isset($_POST["compare"]) && $first == $second && strlen($first) == 1 && strlen($second) == 1) {
            //     echo "<p>" . $_POST["first"] . " y "  . $_POST["second"] . " se riman muy poco</p>";
            // } else if (isset($_POST["compare"]) && substr($first, 1) == substr($second, 1) && strlen($first) == 3 && strlen($second) == 3) {
            //     echo "<p>" . $_POST["first"] . " y "  . $_POST["second"] . " se riman un poco</p>";
            // } else if (isset($_POST["compare"]) && substr($first, 2) == substr($second, 2) && strlen($first) == 3 && strlen($second) == 3) {
            //     echo "<p>" . $_POST["first"] . " y "  . $_POST["second"] . " se riman muy poco</p>";
            // } else {
            //     echo "<p>no se riman</p>";
            // }
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>