<?php
session_name("Primer_login");
require("functions.php");
session_start();

if (isset($_POST["exit"])) {
    session_destroy();
    header("Location: index.php");
    return;
}
if (isset($_SESSION["login"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>We logged in</title>
    </head>

    <body>
        <h1>we are logged in</h1>
        <form action="login.php" method="post">
            <?php
            echo '<p>Hi there ' . $_SESSION['login'] . '</p>';
            ?>
            <button type="submit" name="exit">Exit</button>
        </form>
    </body>

    </html>
<?php
}
