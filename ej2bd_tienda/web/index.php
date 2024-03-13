<?php
require "functions.php";
$list = getAllProd()->answer;
// print_r($list[0]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th {
            background: darkgrey;
        }

        td {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h1>Crud table</h1>
    <?php
    if (isset($_POST["add"])) {
        echo "add form";
    }
    if (isset($_POST["del"])) {
        echo "delete message";
    }
    if (isset($_POST["chng"])) {
        echo "change form";
    }
    ?>
    <form action="index.php" method="post">

        <table border="1px">
            <tr>
                <th>Codigo</th>
                <th>Nombre corto</th>
                <th>PVP</th>
                <th>Descripcion</th>
                <th>Familia</th>
                <th>Acciones <button type="submit" name="add" value="add">+</button></th>
            </tr>
            <?php
            foreach ($list as $value) {
                echo "<tr>";
                echo '<td>' . $value->cod . '</td>';
                echo '<td>' . $value->nombre_corto . '</td>';
                echo '<td>' . $value->PVP . '</td>';
                echo '<td>' . $value->descripcion . '</td>';
                echo '<td>' . $value->familia . '</td>';
                echo '<td><button type="submit" name="del" value="' . $value->cod . '">Eliminar</button><button type="submit" name="chng"value="' . $value->cod . '">Cambiar</button></td>';
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>