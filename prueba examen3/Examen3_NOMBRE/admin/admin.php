<?php
require("../function.php");
session_start();
if (!timeout() && stillExist($_SESSION["usuario"])) {
    function getAllNormal()
    {
        try {
            $conn = mysqli_connect("localhost", USER, PASS, BD_NAME);
            mysqli_set_charset($conn, "utf8");
        } catch (Exception $e) {
            die("<p>no he podido connectarme:" . $e->getMessage() . "</p>");
        }
        try {
            $consulta = "select * from clientes where tipo='normal'";
            $result = mysqli_query($conn, $consulta);
        } catch (Exception $e) {
            mysqli_close($conn);
            die("<p>no hace query:" . $e->getMessage() . "</p></body></html>");
        }
        return $result;
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            th {
                background-color: lightgrey;
                font-size: 900;
            }

            table {
                border-collapse: collapse;
            }

            img {
                height: 50px;
                width: 50px;
            }
        </style>
    </head>

    <body>
        <h1>Video Club</h1>
        <form action="admin.php" method="post">
            <p>Bienvenido <?php echo $_SESSION["usuario"] ?> - <button type="submit" name="back">Salir</button></p>
            <h2>Clientes</h2>
            <h3>Listado de los clientes (no 'admin')</h3>
            <table border="1px">
                <tr>
                    <th>Usuario</th>
                    <th>Foto</th>
                    <th>Opciones</th>
                </tr>
                <?php
                $list = getAllNormal();
                while ($line = mysqli_fetch_assoc($list)) {
                    echo '<tr>';
                    echo '<td>' . $line["usuario"] . '</td>';
                    echo '<td><img src="../img/' . $line["foto"] . '" alt="' . $line["foto"] . '"></td>';
                    echo '<td><button type="submit" name="edit" value="' . $line["usuario"] . '">Editar</button>-<button type="submit" name="del" value="' . $line["usuario"] . '">Borrar</button></td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </form>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
    return;
}
?>