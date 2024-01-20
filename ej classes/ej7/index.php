<?php
require("film.php");
$film1 = new Film();
$film2 = new Film("value2", "2014", "value2", 2, true, "2 January 2024", 1);
$listCli = [$film2];
function showFilmCli($film)
{
    $data = $film->getAllData();
    return [$data[0], $data[2], $data[3], $data[5]];
}
function alarm($fecha)
{
    $estimated = strtotime($fecha);
    if ($estimated > time()) {
        return false;
    }
    return true;
}
function getEstimated($fecha)
{
    $estimated = strtotime($fecha);
    $diff = abs(time() - $estimated);
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    return "$years years, $months months, $days days";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hi there</title>
    <style>
        table {
            border-collapse: collapse;
        }

        .red {
            color: red;
        }
    </style>
</head>

<body>
    <div>
        <h1>Mis peliculas</h1>
        <form action="index.php" method="post">
            <table border="1px">
                <tr>
                    <th>Nombre</th>
                    <th>Director</th>
                    <th>Precio</th>
                    <th>Fecha Devolucion</th>
                    <th>Acciones</th>
                </tr>
                <?php
                if (sizeof($listCli)) {
                    foreach ($listCli as $value) {
                        echo "<tr>";
                        $film = showFilmCli($value);
                        foreach ($film as $v) {
                            if ($v && strtotime($v)) {
                                if (alarm($v)) {
                                    echo "<td class='red'> Fecha estimada<br>" . getEstimated($v) . "</td>";
                                } else {
                                    echo "<td>" . getEstimated($v) . "</td>";
                                }
                            } else {
                                echo "<td>$v</td>";
                            }
                        }
                        echo "<td><button type='submit' name='return'>Volver libro</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<p>No hay libros alquilados</p>";
                }
                ?>
            </table>
        </form>
    </div>
    <div>
        <h1>Todas peliculas</h1>
        <form action="index.php" method="post">
            <table border="1px">
                <tr>
                    <th>Nombre</th>
                    <th>Ano</th>
                    <th>Director</th>
                    <th>Precio</th>
                    <th>Alquilada</th>
                    <th>Fecha devolucion</th>
                    <th>Recarga</th>
                    <th>Acciones</th>
                </tr>
                <?php
                foreach (Film::$list as $value) {
                    echo "<tr>";
                    $film = $value->getAllData();
                    foreach ($film as $v) {
                        echo "<td>$v</td>";
                    }
                    if (!$film[4]) {
                        echo "<td><button type='submit' name='rent'>Alquilar libro</button></td>";
                    } else {
                        echo "<td class='red'>No se puede alquilar</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>
</body>

</html>