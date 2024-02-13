<?php
session_name("ej1");
session_start();
// if (isset($_POST["back"])) {
    // session_destroy();
    // session_unset();
    header("Location: index.php");
    exit;
    // print_r($_SESSION);
// }
?>
