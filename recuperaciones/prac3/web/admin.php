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
    if (isset($_POST["showInfo"])) {
        echo '<h3>Mostrar usuario con id ' . $_POST["showInfo"] . '</h3>';
        $info = json_decode(consumir_servicios_REST("/usuario/" . $_SESSION["api_session"] . "/" . $_POST["showInfo"], "GET"));
        echo "<table>";
        foreach ($info->message[0] as $key => $value) {
            echo "<tr>";
            echo "<td>$key:</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    //delete user
    if (isset($_POST["borrar"]) && $_POST["borrar"] != "") {
        json_decode(consumir_servicios_REST("/borrar/" . $_SESSION["api_session"] . "/" . $_POST["borrar"], "GET"));
    }
    //modify user
    if (isset($_POST["editar"]) && $_POST["editar"] != "") {
        $info = json_decode(consumir_servicios_REST("/usuario/" . $_SESSION["api_session"] . "/" . $_POST["editar"], "GET"))->message[0];
        print_r($info);
        ?>
        <form action="admin.php" method="post">
            <p>
                <label for="ind">ID:</label>
                <input type="text" name="ind" id="ind" value="<?php echo $info->id_usuario ?>">
            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?php echo $info->usuario ?>">
            </p>
            <p>
                <label for="clave">Clave:</label>
                <input type="password" name="clave" id="clave" value="<?php echo $info->clave ?>">
            </p>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $info->nombre ?>">
            </p>
            <p>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" value="<?php echo $info->dni ?>">
            </p>
            <p>
                <label for="hombre">Sexo:</label>

                <label for="hombre">Hombre</label>
                <input type="radio" name="sexo" id="hombre" value="hombre" checked>

                <label for="mujer">Mujer</label>
                <input type="radio" name="sexo" id="mujer" value="mujer" <?php if ($info->sexo == "mujer")
                    echo 'checked' ?>>
                </p>
                <p>
                    <label for="foto">Foto:</label>
                    <input type="file" name="foto" id="foto">
                </p>
                <p>
                    <label for="subscripcion">Subscripcion:</label>
                    <input type="checkbox" name="subscripcion" id="subscripcion" value="1" <?php if ($info->subscripcion == 1)
                    echo 'checked' ?>>
                </p>
                <p>
                    <label for="normal">Tipo:</label>

                    <label for="normal">Normal</label>
                    <input type="radio" name="tipo" id="normal" value="normal" checked>

                    <label for="admin">Admin</label>
                    <input type="radio" name="tipo" id="admin" value="admin" <?php if ($info->tipo == "admin")
                    echo 'checked' ?>>
                </p>
                <button type="submit" name="guardarEditar" value="guardarEditar">Guardar cambios</button>
            </form>
        <?php
    }
    if (isset($_POST["guardarEditar"]) && $_POST["guardarEditar"] != "") {
        $sub = $_POST["subscripcion"] == 1 ? 1 : 0;
        $foto = $_FILES["name"] == "" ? "no_imagen" : $_FILES["name"];
        $res = json_decode(consumir_servicios_REST("/editar/" . $_SESSION["api_session"] . "/" . $_POST["ind"] . "/" . $_POST["usuario"] . "/" . $_POST["clave"] . "/" . $_POST["nombre"] . "/" . $_POST["dni"] . "/" . $_POST["sexo"] . "/" . $foto . "/" . $sub . "/" . $_POST["tipo"], "GET"))->message[0];
        print_r($res);
    }
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
                if ($totalPages > 1) {
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
                echo '<td><button type="submit" name="showInfo" value="' . $value->id_usuario . '">' . $value->nombre . "</button></td>";
                echo '<td><button type="submit" name="borrar" value="' . $value->id_usuario . '">Borrar</button>-<button type="submit" name="editar" value="' . $value->id_usuario . '">Editar</button></td>';
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