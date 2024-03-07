<?php
// session_start();
require "../servicios_rest/src/funciones_servicios.php";
if (isset($_POST["exit"]) && $_POST["exit"]) {
    // print_r($_SESSION["api_session"]);
    // $user = getUser(1, $_SESSION["api_session"]);
    // print_r($user);

    salir($_SESSION["api_session"]);
    header("Location: index.php");
    exit;
}
session_start();
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
            width: 10%;
            background-color: darkgrey;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Gestion de Guardias</h1>
    <form action="guardias.php" method="post">
        <p>Bienvenido
            <?php echo $_SESSION["user"] ?> - <button type="submit" name="exit" value="exit">Salir</button>
        </p>
    </form>
    <h1>Equipos de Guardia del IES Mar de Alboran</h1>
    <form action="guardias.php" method="post">

        <table border="1px">
            <tr>
                <th></th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
            <?php
            $equipo = 1;
            for ($i = 1; $i < 7; $i++) {
                if ($i == 4) {
                    echo "<tr>";
                    echo "<td colspan='6'>RECREO</td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td>$i Hora</td>";
                for ($j = 1; $j < 6; $j++) {
                    $val = $j . ";" . $i;
                    echo "<td><button name='team' value='$val'>Equipo$equipo</button></td>";
                    $equipo++;
                }
                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <?php
    if (isset($_POST["team"])) {
        $val = explode(";", $_POST["team"]);
        echo "here2";
        print_r($_SESSION["api_session"]);
        echo "<br>";
        // $user = getUser(1, $_SESSION["api_session"]);
        // print_r($user);
    }
    ?>
</body>

</html>