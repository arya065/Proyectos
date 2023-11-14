<?php

// if (isset($_POST["login"])) {
// print_r($_GET);
if ($_GET["user"] == 'admin' && $_GET["pass"] == '1234') {
    echo  "<p>Usuario Valido</p>";
    // exit;
} else {
    echo "<p>Usuario no Valido</p>";
    // exit;
}
// }
