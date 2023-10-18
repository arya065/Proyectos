<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <h1>Rellena tu CV</h1>
    <form action="recogida.php" method="post" enctype="multipart/form-data">

        <p><label for="nom">Nombre</label></p>
        <input type="text" id="nom" name="nombre">

        <p><label for="ape">Apellidos</label></p>
        <input type="text" id="ape" name="apellido">

        <p><label for="pass">Contrasena</label></p>
        <input type="password" id="pass" name="password">

        <p><label for="dni">DNI</label></p>
        <input type="text" id="dni" name="dni">

        <p>Sexo</p>
        <input type="radio" id="hom" name="sexo" value="Hombre">
        <label for="hom"><span>Hombre</span></label>
        <br><br>
        <input type="radio" id="muj" name="sexo" value="Mujer">
        <label for="muj"><span>Mujer</span></label>

        <p><label for="foto"><span>Incluir mi foto:</span></label>
            <input type="file" id="foto" name="foto">
        </p>

        <p><label for="ciudad"><span>Nacido en:</span></label>
            <select name="ciudad" id="ciudad">
                <option value="1">Malaga</option>
                <option value="2">no Malga</option>
                <option value="3">no no Malaga</option>
                <option value="4">no no no Malaga</option>
            </select>
        </p>

        <p>
            <label for="comm"><span>Comentarios:</span></label>
            <textarea name="comment" id="comm" cols="30" rows="10"></textarea>
        </p>

        <p><input type="checkbox" id="sub" name="sub"> <label for="sub">Subscribirse al bolerin de Novedades</label></p>

        <p><input type="submit" value="Guardar cambios" name="save">
            <input type="reset" value="Borrar los datos introducidos" name="reset">
        </p>
    </form>
</body>

</html>