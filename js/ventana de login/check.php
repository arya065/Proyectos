<?php
if ($_GET["user"] == 'admin' && $_GET["pass"] == '1234') {
    echo  "<p>Usuario Valido</p>";
} else {
    echo "<p>Usuario no Valido</p>";
}
