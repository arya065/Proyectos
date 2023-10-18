<?php
if (isset($_POST["compare"])) {
    $error_first = $_POST["day1"] == "" || $_POST["month1"] == "" || $_POST["year1"] == "" || !correctDate($_POST["day1"], $_POST["month1"], $_POST["year1"]);
    $error_second = $_POST["day2"] == "" || $_POST["month2"] == "" || $_POST["year2"] == "" || !correctDate($_POST["day2"], $_POST["month2"], $_POST["year2"]);
    $error_form = $error_first || $error_second;
}
function correctDate($day, $month, $year)
{
    return checkdate(trim($month), trim($day), trim($year));
}
function diffdates()
{


    $date1New = strtotime($_POST["month1"] . "/" . $_POST["day1"] . "/" . $_POST["year1"]);
    $date2New = strtotime($_POST["month2"] . "/" . $_POST["day2"] . "/" . $_POST["year2"]);

    return sprintf("%.0f", abs(($date2New - $date1New) / 86400));
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
        <form action="fecha2.php" method="post">

            <p><label for="day1">Introduzca una fecha:</label></p>
            <p>
                <label for="day1">Dia:</label>
                <select name="day1" id="day1">
                    <option value="1" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "1")) echo "selected" ?>>1</option>
                    <option value="2" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "2")) echo "selected" ?>>2</option>
                    <option value="3" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "3")) echo "selected" ?>>3</option>
                    <option value="4" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "4")) echo "selected" ?>>4</option>
                    <option value="5" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "5")) echo "selected" ?>>5</option>
                    <option value="6" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "6")) echo "selected" ?>>6</option>
                    <option value="7" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "7")) echo "selected" ?>>7</option>
                    <option value="8" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "8")) echo "selected" ?>>8</option>
                    <option value="9" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "9")) echo "selected" ?>>9</option>
                    <option value="10" <?php if ((isset($_POST["day1"]) && $_POST["day1"] == "10")) echo "selected" ?>>10</option>
                </select>
                <label for="month1">Mes:</label>
                <select name="month1" id="month1">
                    <option value="1" <?php if ((isset($_POST["month1"]) && $_POST["month1"] == "1")) echo "selected" ?>>Enero</option>
                    <option value="2" <?php if ((isset($_POST["month1"]) && $_POST["month1"] == "2")) echo "selected" ?>>Febrero</option>
                    <option value="3" <?php if ((isset($_POST["month1"]) && $_POST["month1"] == "3")) echo "selected" ?>>Marzo</option>
                    <option value="4" <?php if ((isset($_POST["month1"]) && $_POST["month1"] == "4")) echo "selected" ?>>Abril</option>
                    <option value="5" <?php if ((isset($_POST["month1"]) && $_POST["month1"] == "5")) echo "selected" ?>>May</option>
                    <option value="6" <?php if ((isset($_POST["month1"]) && $_POST["month1"] == "6")) echo "selected" ?>>Junio</option>
                </select>
                <label for="year1">Ano:</label>
                <select name="year1" id="year1">
                    <option value="1970" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1970")) echo "selected" ?>>1970</option>
                    <option value="1971" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1971")) echo "selected" ?>>1971</option>
                    <option value="1972" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1972")) echo "selected" ?>>1972</option>
                    <option value="1973" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1973")) echo "selected" ?>>1973</option>
                    <option value="1974" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1974")) echo "selected" ?>>1974</option>
                    <option value="1975" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1975")) echo "selected" ?>>1975</option>
                    <option value="1976" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1976")) echo "selected" ?>>1976</option>
                    <option value="1977" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1977")) echo "selected" ?>>1977</option>
                    <option value="1978" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1978")) echo "selected" ?>>1978</option>
                    <option value="1979" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1979")) echo "selected" ?>>1979</option>
                    <option value="1980" <?php if ((isset($_POST["year1"]) && $_POST["year1"] == "1980")) echo "selected" ?>>1980</option>
                </select>
            </p>
            <?php
            if ($_POST["compare"] && $error_first) {
                echo "<span>Fecha invalida</span>";
            }
            ?>
            <p>
                <label for="second">Introduzca otra fecha:</label>
            </p>
            <p>
                <label for="day2">Dia:</label>
                <select name="day2" id="day2">
                    <option value="1" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "1")) echo "selected" ?>>1</option>
                    <option value="2" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "2")) echo "selected" ?>>2</option>
                    <option value="3" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "3")) echo "selected" ?>>3</option>
                    <option value="4" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "4")) echo "selected" ?>>4</option>
                    <option value="5" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "5")) echo "selected" ?>>5</option>
                    <option value="6" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "6")) echo "selected" ?>>6</option>
                    <option value="7" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "7")) echo "selected" ?>>7</option>
                    <option value="8" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "8")) echo "selected" ?>>8</option>
                    <option value="9" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "9")) echo "selected" ?>>9</option>
                    <option value="10" <?php if ((isset($_POST["day2"]) && $_POST["day2"] == "10")) echo "selected" ?>>10</option>
                </select>
                <label for="month2">Mes:</label>
                <select name="month2" id="month2">
                    <option value="1" <?php if ((isset($_POST["month2"]) && $_POST["month2"] == "1")) echo "selected" ?>>Enero</option>
                    <option value="2" <?php if ((isset($_POST["month2"]) && $_POST["month2"] == "2")) echo "selected" ?>>Febrero</option>
                    <option value="3" <?php if ((isset($_POST["month2"]) && $_POST["month2"] == "3")) echo "selected" ?>>Marzo</option>
                    <option value="4" <?php if ((isset($_POST["month2"]) && $_POST["month2"] == "4")) echo "selected" ?>>Abril</option>
                    <option value="5" <?php if ((isset($_POST["month2"]) && $_POST["month2"] == "5")) echo "selected" ?>>May</option>
                    <option value="6" <?php if ((isset($_POST["month2"]) && $_POST["month2"] == "6")) echo "selected" ?>>Junio</option>
                </select>
                <label for="year1">Ano:</label>
                <select name="year2" id="year2">
                    <option value="1970" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1970")) echo "selected" ?>>1970</option>
                    <option value="1971" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1971")) echo "selected" ?>>1971</option>
                    <option value="1972" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1972")) echo "selected" ?>>1972</option>
                    <option value="1973" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1973")) echo "selected" ?>>1973</option>
                    <option value="1974" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1974")) echo "selected" ?>>1974</option>
                    <option value="1975" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1975")) echo "selected" ?>>1975</option>
                    <option value="1976" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1976")) echo "selected" ?>>1976</option>
                    <option value="1977" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1977")) echo "selected" ?>>1977</option>
                    <option value="1978" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1978")) echo "selected" ?>>1978</option>
                    <option value="1979" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1979")) echo "selected" ?>>1979</option>
                    <option value="1980" <?php if ((isset($_POST["year2"]) && $_POST["year2"] == "1980")) echo "selected" ?>>1980</option>
                </select>
                <?php
                if ($_POST["compare"] && $error_second) {
                    echo "<span>Fecha invalida</span>";
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
            echo diffdates(), "</p>";
            ?>
        </div>
    <?php
    }
    ?>

</body>

</html>