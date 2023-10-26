<?php
function mi_explode($string, $delimiter, $previous_pos)
{
    $result = [];
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == $delimiter) {
            $result[] = mi_substr($string, $previous_pos + 1, $i);
            $previous_pos = $i;
        }
    }
    return $result;
}
function mi_explode_first($string, $delimiter) //отделяет первый кусок до delimiter
{
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] === $delimiter) {
            return mi_substr($string, 0, $i);
        }
    }
}
function mi_substr($string, $start, $end = null)
{
    if ($end == null) {
        $end = strlen($string);
    }
    $volver = "";
    for ($i = $start; $i < $end; $i++) {
        $volver = $volver . $string[$i];
    }
    return $volver;
}
function createFile($file)
{
    move_uploaded_file($file["tmp_name"], "Horario/horarios.txt");
}
function correctFile($file)
{
    if ($file["size"] > 1048576) {
        return false;
    }
    if ($file["type"] != "text/plain") {
        return false;
    }
    return true;
}
