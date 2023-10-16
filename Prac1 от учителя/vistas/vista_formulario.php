<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1 - Formulario</title>
    <style>
        .error{color:red}
    </style>
</head>
<body>
    <h1>Rellena tu CV</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label><br/>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
            <?php
            if(isset($_POST["btnGuardarCambios"])&& $error_nombre)
                echo "<span class='error'> Campo vacío </span>";
            ?>
        </p>
        <p>
            <label for="apellidos">Apellidos</label><br/>
            <input type="text" name="apellidos" id="apellidos" value="<?php if(isset($_POST["apellidos"])) echo $_POST["apellidos"];?>"/>
            <?php
            if(isset($_POST["btnGuardarCambios"])&& $error_apellidos)
                echo "<span class='error'> Campo vacío </span>";
            ?>
        </p>
        <p>
            <label for="clave">Contraseña</label><br/>
            <input type="password" name="clave" id="clave"/>
            <?php
            if(isset($_POST["btnGuardarCambios"])&& $error_clave)
                echo "<span class='error'> Campo vacío </span>";
            ?>
        </p>
        <p>Sexo
        <?php
            if(isset($_POST["btnGuardarCambios"])&& $error_sexo)
                echo "<span class='error'> Debes seleccionar un Sexo </span>";
            ?>
            <br/>
            <input type="radio" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="hombre") echo "checked";?> name="sexo" id="hombre" value="hombre"/><label for="hombre">Hombre</label><br/>
            <input type="radio" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?> name="sexo" id="mujer" value="mujer"/><label for="mujer">Mujer</label>
        </p>
        <p>
            <label for="foto">Incluir mi foto</label>
            <input type="file" name="foto" id="foto" accept="image/*"/>
        </p>
        <p>
            <label for="nacido">Nacido en:</label>
            <select id="nacido" name="nacido">
                <option value="Málaga" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Málaga") echo "selected";?>>Málaga</option>
                <option value="Marbella" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Marbella") echo "selected";?>>Marbella</option>
                <option value="Istán" <?php if(!isset($_POST["nacido"]) || (isset($_POST["nacido"]) && $_POST["nacido"]=="Istán")) echo "selected";?>>Istán</option>
            </select>
        </p>
        <p>
            <label for="comentarios">Comentarios:</label>
            <textarea id="comentarios" name="comentarios">
                <?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"];?>
            </textarea>
            <?php
            if(isset($_POST["btnGuardarCambios"])&& $error_comentarios)
                echo "<span class='error'> Campo vacío </span>";
            ?>
        </p>
        <p>
            <input type="checkbox" ckecked name="subscripcion" id="subscripcion"/>
            <label for="subscripcion">Subscribirse al boletín de Novedades</label>
        </p>
        <p>
            <button type="submit" name="btnGuardarCambios">Guardar Cambios</button>
            <button type="reset" name="btnborrar">Borrar los datos introducidos</button>
        </p>
        
    </form>
</body>
</html>