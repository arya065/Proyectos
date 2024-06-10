<?php
require "../functions_clients.php";
session_name("client_session");
session_start();
if (isset($_POST["exit"]) || timeout($_SESSION["last_active"])) {
    salir($_SESSION["api_session"]);
    session_destroy();
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Notas de alumnos</h1>
    <form action="student.php" method="post">
        <p>Bienvenido <b><?php echo $_SESSION["usuario"] ?></b> <button type="submit" name="exit"
                value="exit">Salir</button>
        </p>
    </form>
    <table border="1px">
        <tr>
            <th>Asignatura</th>
            <th>Nota</th>
        </tr>
        <?php
        $notas = notasAlumno($_SESSION["api_session"], $_SESSION["cod_usu"]);
        if (isset($notas->error)) {
            echo "<tr><td>algun error</td></tr>";
        } else {
            foreach ($notas->notas as $key => $value) {
                echo "<tr>";
                echo "<td>" . $value->denominacion . "</td>";
                echo "<td>" . $value->nota . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>