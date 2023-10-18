<?php
if (isset($_POST["compare"])) {
    $error_first = $_POST["first"] == "" || correctDate($_POST["first"]);
    $error_second = $_POST["second"] == "" || correctDate($_POST["second"]);
    $error_form = $error_first || $error_second;
}
function correctDate($date)
{
    $date = trim($date);
    $day = date("m", strtotime($date));
    $month = date("d", strtotime($date));
    $year = date("y", strtotime($date));
    return !checkdate($month, $day, $year);
}
function diffdates($date1, $date2)
{
    $date1 = trim($date1);
    $date2 = trim($date2);

    $day1 = date("m", strtotime($date1));
    $month1 = date("d", strtotime($date1));
    $year1 = date("y", strtotime($date1));

    $day2 = date("m", strtotime($date2));
    $month2 = date("d", strtotime($date2));
    $year2 = date("y", strtotime($date2));

    $date1New = strtotime($month1 . "/" . $day1 . "/" . $year1);
    $date2New = strtotime($month2 . "/" . $day2 . "/" . $year2);

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
        <form action="fecha1.php" method="post">
            <p>
                <label for="first">Una Fecha (DD/MM/YYYY): </label>
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
            <p>
                <label for="second">Otra Fecha (DD/MM/YYYY): </label>
                <input type="text" id="second" name="second" value="<?php if (isset($_POST["second"])) echo $_POST["second"] ?>">
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