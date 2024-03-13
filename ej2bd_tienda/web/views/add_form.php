<?php
session_start();
?>
<form action="http://localhost/Proyectos/ej2bd_tienda/web/index.php" method="post">
    <p>
        <label for="code">Codigo:</label>
        <input type="text" name="code" id="code" value="<?php if (isset($_SESSION["code"]))
            echo $_SESSION["code"] ?>">
            <?php
        if (isset($_SESSION["code"]) && $_SESSION["code"] == "") {
            echo '<span class="err">campo vacio</span>';
        }
        ?>
    </p>
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_SESSION["nombre"]))
            echo $_SESSION["nombre"] ?>">
            <?php
        if (isset($_SESSION["nombre"]) && $_SESSION["nombre"] == "") {
            echo '<span class="err">campo vacio</span>';
        }
        ?>
    </p>
    <p>
        <label for="nombreCorto">Nombre Corto:</label>
        <input type="text" name="nombreCorto" id="nombreCorto" value="<?php if (isset($_SESSION["nombreCorto"]))
            echo $_SESSION["nombreCorto"] ?>">
            <?php
        if (isset($_SESSION["nombreCorto"]) && $_SESSION["nombreCorto"] == "") {
            echo '<span class="err">campo vacio</span>';
        }
        ?>
    </p>
    <p>
        <label for="descr">Descripcion:</label>
        <input type="text" name="descr" id="descr" value="<?php if (isset($_SESSION["descr"]))
            echo $_SESSION["descr"] ?>">
            <?php
        if (isset($_SESSION["descr"]) && $_SESSION["descr"] == "") {
            echo '<span class="err">campo vacio</span>';
        }
        ?>
    </p>
    <p>
        <label for="pvp">PVP:</label>
        <input type="text" name="pvp" id="pvp" value="<?php if (isset($_SESSION["pvp"]))
            echo $_SESSION["pvp"] ?>">
            <?php
        if (isset($_SESSION["pvp"]) && $_SESSION["pvp"] == "") {
            echo '<span class="err">campo vacio</span>';
        }
        ?>
    </p>
    <p>
        <label for="familia">Familia:</label>
        <input type="text" name="familia" id="familia" value="<?php if (isset($_SESSION["familia"]))
            echo $_SESSION["familia"] ?>">
            <?php
        if (isset($_SESSION["familia"]) && $_SESSION["familia"] == "") {
            echo '<span class="err">campo vacio</span>';
        }
        ?>
    </p>
    <button type="submit" name="send" value="add">Subir</button>
    <button type="submit" name="send" value="back">Cancelar</button>
</form>