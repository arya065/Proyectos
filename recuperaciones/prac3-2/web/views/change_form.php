<?php
session_start();
?>
<form action="http://localhost/Proyectos/ej2bd_tienda/web/index.php" method="post">
    <p><label for="code">Codigo:</label><input type="text" name="code" id="code" value="<?php if (isset($_SESSION["code"]))
        echo $_SESSION["code"] ?>"></p>
        <p><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" value="<?php if (isset($_SESSION["nombre"]))
        echo $_SESSION["nombre"] ?>"></p>
        <p><label for="nombreCorto">Nombre Corto:</label><input type="text" name="nombreCorto" id="nombreCorto" value="<?php if (isset($_SESSION["nombreCorto"]))
        echo $_SESSION["nombreCorto"] ?>"></p>
        <p><label for="descr">Descripcion:</label><input type="text" name="descr" id="descr" value="<?php if (isset($_SESSION["descr"]))
        echo $_SESSION["descr"] ?>"></p>
        <p><label for="pvp">PVP:</label><input type="text" name="pvp" id="pvp" value="<?php if (isset($_SESSION["pvp"]))
        echo $_SESSION["pvp"] ?>"></p>
        <p><label for="familia">Familia:</label><input type="text" name="familia" id="familia" value="<?php if (isset($_SESSION["familia"]))
        echo $_SESSION["familia"] ?>"></p>
        <button type="submit" name="send" value="add">Subir</button>
        <button type="submit" name="send" value="back">Cancelar</button>
    </form>