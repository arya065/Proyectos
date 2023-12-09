<?php
session_start();
if (isset($_POST["first"])) {
    $_SESSION["first"] = $_SESSION["first"] + 10;
} else if (isset($_POST["back"])){
    $_SESSION["first"] = 0;
    $_SESSION["second"] = 0;
}
header("Location: index.php");
return;
