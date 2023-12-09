<?php
session_start();
// print_r($_POST);
if (isset($_POST["left"])) {
    $_SESSION["axis"] = $_SESSION["axis"] - 100;
} else if (isset($_POST["back"])) {
    $_SESSION["axis"] = 0;
} else {
    $_SESSION["axis"] = $_SESSION["axis"] + 100;
}

if ($_SESSION["axis"] < -300) {
    $diff = $_SESSION["axis"] + 300;
    $_SESSION["axis"] = 300 - $dif;
} else if ($_SESSION["axis"] > 300) {
    $diff = $_SESSION["axis"] - 300;
    $_SESSION["axis"] = -300 + $diff;
}
header("Location: index.php");
return;
