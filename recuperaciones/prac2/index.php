<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Segundo Formulario</h1>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <label for="nacido">Nacido en:</label>
            <select name="nacido" id="nacido">
                <option value="1">Malaga</option>
                <option value="2">Cadiz</option>
                <option value="3">Granada</option>
            </select>
        </p>
        <p>
            <label for="hombre">Sexo:</label>
            <label for="hombre">Hombre</label>
            <input type="radio" name="sexo" id="hombre">
            <label for="mujer">Mujer</label>
            <input type="radio" name="sexo" id="mujer">
        </p>
        <p>
            <label for="deportes">Aficiones:</label>
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="aficiones" id="deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="aficiones" id="lectura">
            <label for="otros">Otros</label>
            <input type="checkbox" name="aficiones" id="otros">
        </p>
        <p>
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" cols="20" rows="2"></textarea>
        </p>
        <p>
            <label for="foto">Incluir mi foto (Archivo de tipo imagen Max. 500KB)</label>
            <input type="file" name="foto" id="foto">
        </p>
        <p>
            <input type="submit" value="Enviar">
            <input type="reset" value="Borrar Campos">
        </p>
    </form>
</body>

</html>