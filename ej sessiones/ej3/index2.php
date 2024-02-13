<?php
session_start();
if (isset($_POST["mice"])) {
    $_SESSION["number"] = $_SESSION["number"] - 1;
} else if (isset($_POST["back"])) {
    $_SESSION["number"] = 0;
} else {
    $_SESSION["number"] = $_SESSION["number"] + 1;
}

header("Location: index.php");
return;
