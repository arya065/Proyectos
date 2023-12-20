<?php
    // SERVIDOR_BD,USUARIO_BD,CLAVE_BD y NOMBRE_BD son CTES

    //Conexión con PDO
    $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    
    // Conexión mysqli
    $conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf-8");

    //Algunas funciones y metodos según conexion PDO ó mysqli
    $ultim_id=$conexion->lastInsertId();

    $ultim_id=mysqli_insert_id($conexion);
?>