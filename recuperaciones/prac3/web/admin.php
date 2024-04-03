<?php
session_name("cliente");
session_start();
require "funciones_cliente.php";
// print_r($_SESSION);

//log out
if (isset($_POST["exit"]) && $_POST["exit"] == "exit") {
    session_destroy();
    header("Location: index.php");
    return;
}
//pagination change items per page number
if (isset($_POST["page"]) && $_POST["page"] != "") {
    $_SESSION["itemPerPage"] = $_POST["page"];
}
//pagination switch pages
if (isset($_POST["cur"]) && $_POST["cur"] != "") {
    if ($_SESSION["itemPerPage"] == "all") {
        switchPage(1);
    } else if ($_POST["cur"] == "next") {
        $_SESSION["current"] += 1;
        switchPage($_SESSION["current"]);
    } else if ($_POST["cur"] == "prev") {
        $_SESSION["current"] -= 1;
        switchPage($_SESSION["current"]);
    } else {
        switchPage($_POST["cur"]);
    }
    header("Location: admin.php");
    return;
}
function switchPage($page)
{
    $_SESSION["current"] = $page;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th {
            background: lightgray;
            width: 20vw;
        }

        td {
            text-align: center;
        }

        .pagination {
            margin: auto;
            margin-top: 20px;
            text-align: center;
        }

        .current-page {
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <h1>Practica Rec2</h1>
    <form action="admin.php" method="post">
        <p>Bienvenido
            <?php echo $_SESSION["usuario"] ?> -
            <button type="submit" name="exit" value="exit">Salir</button>
        </p>
    </form>
    <?php
    //show user info
    if (isset($_POST["nombre"])) {
        echo '<h3>Mostrar usuario con id ' . $_POST["nombre"] . '</h3>';
        $info = json_decode(consumir_servicios_REST("/usuario/" . $_SESSION["api_session"] . "/" . $_POST["nombre"], "GET"));
        echo "<table>";
        foreach ($info->message[0] as $key => $value) {
            echo "<tr>";
            echo "<td>$key:</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    //add user form
    //modify user form
    ?>
    <h2>Listado de los usuarios</h2>
    <form action="admin.php" method="post">
        <p>Mostrar
            <select name="page" id="page">
                <option value="2" <?php if (($_SESSION["itemPerPage"] == 2) || (isset($_POST["page"]) && $_POST["page"] == 2))
                    echo "selected" ?>>2</option>
                    <option value="3" <?php if (($_SESSION["itemPerPage"] == 3) || (isset($_POST["page"]) && $_POST["page"] == 3))
                    echo "selected" ?>>3</option>
                    <option value="all" <?php if (($_SESSION["itemPerPage"] == "all") || (isset($_POST["page"]) && $_POST["page"] == "all"))
                    echo "selected" ?>>Todo</option>
                </select>
            </p>
            <p>
                <input type="text" name="find" id="find" value="<?php if (isset($_POST["find"]))
                    echo $_POST["find"] ?>">
                <button type="submit" name="buscar" value="buscar">Buscar</button>
            </p>
            <?php
                //get user list
                $response = json_decode(consumir_servicios_REST("/usuarios/" . $_SESSION["api_session"], "GET"));
                // get user list with find
                if (isset($_POST["buscar"]) && $_POST["find"] != "") {
                    $response = json_decode(consumir_servicios_REST("/buscar/" . $_SESSION["api_session"] . "/" . $_POST["find"], "GET"));
                }
                //get user list with pagination
                if ($_SESSION["itemPerPage"] == "all") {
                    $totalPages = 1;
                } else {
                    $totalPages = ceil(count($response->message) / $_SESSION["itemPerPage"]);
                }
                if ($totalPages != 1) {
                    $response = json_decode(consumir_servicios_REST("/paginacion/" . $_SESSION["api_session"] . "/" . $_SESSION["current"] . "/" . $_SESSION["itemPerPage"], "GET"));
                }
                ?>
        <table border="1px">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th><button type="submit" name="add" value="add">Usuario+</button></th>
            </tr>
            <?php
            foreach ($response->message as $value) {
                echo "<tr>";
                echo "<td>" . $value->id_usuario . "</td>";
                echo "<td>" . $value->foto . "</td>";
                echo '<td><button type="submit" name="nombre" value="' . $value->id_usuario . '">' . $value->nombre . "</button></td>";
                echo '<td><button type="submit" name="borrar" value="borrar">Borrar</button>-<button type="submit" name="editar" value="editar">Editar</button></td>';
                echo "</tr>";
            }
            ?>
        </table>
        <div class="pagination">
            <?php
            if ($_SESSION["current"] != 1) {
                echo '<button type="submit" name="cur" value="prev"><</button>';
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $_SESSION["current"]) {
                    $class = "current-page";
                } else {
                    $class = "";
                }
                echo '<button class="' . $class . '" type="submit" name="cur" value="' . $i . '">' . $i . '</button>';
            }
            if ($_SESSION["current"] != $totalPages) {
                echo '<button type="submit" name="cur" value="next">></button>';
            }
            ?>
        </div>
    </form>
</body>

</html>