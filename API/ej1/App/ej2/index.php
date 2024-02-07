<?php
require "./functions.php";
$list = getAllProd();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud API</title>
    <style>
        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Listado de productos</h1>
    <table border="1px">
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Accion</th>
        </tr>
        <?php
        foreach ($list->message as $value) {
            echo "<tr>";
            foreach ($value as $value2) {
                echo "<td>";
                print_r($value2);
                echo "<br>";
                echo "</td>";
            }
            echo "<td>Borrar-modificar</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>