<?php
session_start();
require "./functions.php";
$list = getAllProd();
function del($id)
{
    borrarProd($id);
}
function show($id)
{
    print_r(getProdCod($id));
}
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
    <form action="index.php" method="post" enctype="multipart/form-data">
        <table border="1px">
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Accion</th>
            </tr>
            <?php
            foreach ($list->message as $value) {
                echo "<tr>";
                $tmp = 0;
                foreach ($value as $key => $value2) {
                    if ($key == "codigo") {
                        $tmp = $value2;
                    }
                    echo "<td>";
                    echo $value2;
                    echo "<br>";
                    echo "</td>";
                }
                echo "<td>";
                echo '<button type="submit" name="del" value="' . $tmp . '">Borrar</button>';
                echo '<button type="submit" name="mod" value="' . $tmp . '">Modificar</button>';
                echo '<button type="submit" name="read" value="' . $tmp . '">Mostrar</button>';
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <?php
    if (isset($_POST["del"])) {
        del($_POST["del"]);
    }
    if (isset($_POST["read"])) {
        show($_POST["read"]);
    }
    if (isset($_POST["mod"])) {
        print_r($_POST["mod"]);
    }
    ?>
</body>

</html>