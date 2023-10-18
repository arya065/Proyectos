<?php
if (isset($_POST["compare"])) {
    $error_first = $_POST["first"] == "";
    $error_second = $_POST["second"] == "";
    $error_form = $error_first || $error_second;
}

function diffdates()
{
    $date1New = strtotime($_POST["first"]);
    $date2New = strtotime($_POST["second"]);
    return sprintf("%.0f", ($date2New - $date1New) / 86400);
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
        <h1>Fechas - Formulario</h1>
        <form action="fecha3.php" method="post">
            <p>
                <label for="first">Una Fecha (DD/MM/YYYY): </label>
                <input type="date" name="first" id="first" value="<?php if (isset($_POST["first"])) echo $_POST["first"] ?>">
                <?php
                if (isset($_POST["compare"])) {
                    if ($error_first) {
                ?>
                        <span>*Campo Vacio*</span>
                <?php
                    }
                }
                ?>
            </p>
            <p>
                <label for="second">Otra Fecha (DD/MM/YYYY): </label>
                <input type="date" name="second" id="second" value="<?php if (isset($_POST["second"])) echo $_POST["second"] ?>">

                <?php
                if (isset($_POST["compare"])) {
                    $_POST["second"] = trim($_POST["second"]);
                    if ($error_second) {
                ?>
                        <span>*Campo Vacio*</span>
                <?php
                    }
                }
                ?>
            </p>
            <input type="submit" value="Calcular" name="compare">
        </form>
    </div>

    <?php
    if (isset($_POST["compare"]) && !$error_form) {
    ?>
        <div class="results">
            <h1>Fechas - Respuesta</h1>
            <?php
            //Логкигка
            echo "<p>La diferencia en dias entre las dos fechas introducidas es ";
            echo diffdates($_POST["first"], $_POST["second"]), "</p>";
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>