<?php
session_start();
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
            margin: auto;
        }

        th {
            background: darkgrey;
        }

        .err {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Crud table</h1>
    <?php
    //table form
    if (isset($_POST["add"])) {
        require "views/add_form.php";
    } elseif (isset($_POST["del"])) {
        echo "delete message";
    } else if (isset($_POST["chng"])) {
        require "views/change_form.php";
    }

    //add form
    if (isset($_POST["send"]) && $_POST["send"] == "add") {
        unset($_SESSION["code"], $_SESSION["nombre"], $_SESSION["nombreCorto"], $_SESSION["descr"], $_SESSION["pvp"], $_SESSION["familia"]);
        $res = formControl($_POST["code"], $_POST["nombre"], $_POST["nombreCorto"], $_POST["descr"], $_POST["pvp"], $_POST["familia"]);
        $_SESSION["code"] = $_POST["code"];
        $_SESSION["nombre"] = $_POST["nombre"];
        $_SESSION["nombreCorto"] = $_POST["nombreCorto"];
        $_SESSION["descr"] = $_POST["descr"];
        $_SESSION["pvp"] = $_POST["pvp"];
        $_SESSION["familia"] = $_POST["familia"];
        if ($res) {
            require "views/add_form.php";
        } else {
            unset($_SESSION["code"], $_SESSION["nombre"], $_SESSION["nombreCorto"], $_SESSION["descr"], $_SESSION["pvp"], $_SESSION["familia"]);
        }
    } else if (isset($_POST["send"]) && $_POST["send"] == "back") {
        unset($_SESSION["code"], $_SESSION["nombre"], $_SESSION["nombreCorto"], $_SESSION["descr"], $_SESSION["pvp"], $_SESSION["familia"]);
    }
    //change form
    
    ?>
    <form action="index.php" method="post">

        <table border="1px">
            <tr>
                <th>Codigo</th>
                <th>Nombre corto</th>
                <th>PVP</th>
                <th>Acciones <button type="submit" name="add" value="add">+</button></th>
            </tr>
            <?php
            foreach ($list as $value) {
                echo "<tr>";
                echo '<td>' . $value->cod . '</td>';
                echo '<td>' . $value->nombre_corto . '</td>';
                echo '<td>' . $value->PVP . '</td>';
                // echo '<td>' . $value->descripcion . '</td>';
                // echo '<td>' . $value->familia . '</td>';
                echo '<td><button type="submit" name="del" value="' . $value->cod . '">Borrar</button><button type="submit" name="chng"value="' . $value->cod . '">Editar</button></td>';
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</body>

</html>