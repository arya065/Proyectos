<!-- проверка на ошибки заполнения формы -->
<!-- если форма правильно заполнена, отправка на страницу с ответами -->
<!-- если есть ошибка, возвращение на форму -->
<?php
// $error_form = false;
if (isset($_POST["send"])) {
    $err_name = $_POST["name"] == "";
    $err_sex = !isset($_POST["sexo"]);
    // $err_hobby = !isset($_POST["hobby"]);
    // $error_comment = $_POST["comment"] == "";

    $error_form = $err_name || $err_sex ;
}
if (isset($_POST["send"]) && !$error_form) {
    require "vistas/vista_answ.php";
} else {
    require "vistas/vista_form.php";
}
?>