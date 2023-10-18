<?php

    if(isset($_POST["btnGuardarCambios"]))//Compruebo errores
    {
        $error_nombre=$_POST["nombre"]=="";
        $error_apellidos=$_POST["apellidos"]=="";
        $error_clave=$_POST["clave"]=="";
        $error_sexo=!isset($_POST["sexo"]);
        $error_comentarios=$_POST["comentarios"]=="";
        $error_form=$error_nombre||$error_apellidos||$error_clave||$error_sexo||$error_comentarios;

    }
    if(isset($_POST["btnGuardarCambios"])&&!$error_form)
    {
        require "vistas/vista_respuestas.php";
    }
    else
    {
        require "vistas/vista_formulario.php";
    }
