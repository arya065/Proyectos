<?php
require("film.php");
$film1 = new Film();
// $film1->__destruct();
$film2 = new Film("value2", "2014", "value2", 2, true, "2 January 2024", 1);
foreach (Film::$list as $value) {
    print_r($value->getName());
    echo "<br>";
}
// print_r($film1->getAllData());
$listCli = [$film1];
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
    // echo $diff, '<br>';
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
                // print_r($film1);
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

    </div>
</body>

</html>