<?php
session_start();
// print_r($_POST);
if (isset($_POST["left"])) {
    $_SESSION["axis"] = $_SESSION["axis"] - 100;
} else if (isset($_POST["back"])) {
    $_SESSION["axis"] = 0;
} else if (isset($_POST["right"])) {
    $_SESSION["axis"] = $_SESSION["axis"] + 100;
} else if (isset($_POST["top"])) {
    $_SESSION["axisY"] = $_SESSION["axisY"] - 100;
} else if (isset($_POST["bot"])) {
    $_SESSION["axisY"] = $_SESSION["axisY"] + 100;
}
header("Location: index.php");
return;
