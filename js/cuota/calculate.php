<?php
if ($_GET["capital"] == '' || $_GET["interes"] == '' || $_GET["plazo"] == '') {
    echo  "<p>Vacio</p>";
} else {
    $capital = $_GET["capital"];
    $interes = ($_GET["interes"] / 100 / 12);
    $plazo = $_GET["plazo"];
    // $result = $capital * ($interes + ($interes / (1 + $interes) * ($plazo - 1)));
    $coef = $interes * pow((1 + $interes), $plazo) / (pow((1 + $interes), $plazo) - 1);
    echo $capital * $coef;
}

//interesmens = interes/100/12
//cuota = (interesmens*capital) / (1 - pow(1 + interesmens, -plazo))

//Платеж=Кредит*(Проц+(Проц/(1+Проц)*Мес-1)), где
// Платеж – размер ежемесячной аннуитетной выплаты;
// Кредит – сумма кредита;
// Проц – величина процентной ставки;
// Мес – срок действия кредита.
