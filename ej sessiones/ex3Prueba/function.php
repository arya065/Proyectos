<?php
define("BD_SERVER", "localhost");
define("USER", "root");
define("PASS", "qwer");
define("BD_NAME", "video_club");

function query()
{
    try {
        $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
        mysqli_set_charset($conn, "utf8");
    } catch (Exception $e) {
        die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
    }
    try {
        $consulta = "query";
        $result = mysqli_query($conn, $consulta);
    } catch (Exception $e) {
        mysqli_close($conn);
        die("<p>no he podido eliminar:" . $e->getMessage() . "</p></body></html>");
    }
    return $result;
}
function LetraNIF($dni)
{
    $letter = substr($_POST["dni"], strlen($_POST["dni"]) - 1);
    $dni = substr($_POST["dni"], 0, strlen($_POST["dni"]) - 1); //get only numbers
    if (is_numeric($dni)) {
        $valor = (int) ($dni / 23);
        $valor *= 23;
        $valor = $dni - $valor;
        $letras = "TRWAGMYFPDXBNJZSQVHLCKEO";
        $letraNif = substr($letras, $valor, 1);
        return $letraNif == $letter;
    } else {
        return false;
    }
}
