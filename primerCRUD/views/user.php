<?php
require("../function.php");
session_start();
if (!timeout() || stillExist($_SESSION["username"])) {
    var_dump(timeout());
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: ../index.php");
        return;
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
        <h1>Buenas, <?php echo $_SESSION['username'] ?></h1>
        <form action="user.php" method="post">
            <button type="submit" name="logout">Salir</button>
        </form>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
    return;
}
?>