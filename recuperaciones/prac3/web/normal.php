<?php
session_name("cliente");
session_start();
// print_r($_SESSION);

if (isset($_POST["exit"]) && $_POST["exit"] == "exit") {
    session_destroy();
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normal</title>
</head>

<body>
    <h1>Practica Rec2</h1>
    <form action="normal.php" method="post">
        <p>Bienvenido
            <?php echo $_SESSION["usuario"] ?> -
            <button type="submit" name="exit" value="exit">Salir</button>
        </p>
    </form>
</body>

</html>