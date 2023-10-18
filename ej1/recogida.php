<?php
if (isset($_POST["save"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recogida de datos</title>
    </head>

    <body>
        <h1>Recogiendo datos</h1>
        <?php
        // //создание и перебор массива
        // $a[0] = 3;
        // $a[1] = 6;
        // $a[2] = -1;
        // $a[3] = "hola";

        // for ($i = 0; $i < count($a); $i++) {
        //     echo "<p>Numero: $a[$i] </p>";
        // }



        echo "<p><strong>Nombre:  </strong>" . $_POST["nombre"] . "</p>";
        echo "<p><strong>Apellido:  </strong>" . $_POST["apellido"] . "</p>";
        echo "<p><strong>Password:  </strong>" . $_POST["password"] . "</p>";
        echo "<p><strong>DNI:  </strong>" . $_POST["dni"] . "</p>";

        // isset вроде используется для того чтобы узнать если есть выбор
        if (isset($_POST["sexo"])) {
            echo "<p><strong>Sexo:  </strong>" . $_POST["sexo"] . "</p>";
        } else {
            echo "<p>No seleccionado</p>";
        }

        echo "<p><strong>Nacido:  </strong>" . $_POST["ciudad"] . "</p>";
        echo "<p><strong>Comentario:  </strong>" . $_POST["comment"] . "</p>";

        if (isset($_POST["sub"])) {
            echo "<p><strong>Subscribirse:  </strong>" . $_POST["sub"] . "</p>";
        } else {
            echo "<p>No subs</p>";
        }


        // if (isset($_POST["save"])) {
        //     echo "<p>lo de antes</p>";
        // } else {
        //     echo "<p>No subs</p>";
        // }
        ?>
    </body>

    </html>
<?php
} else {
    header("Location:index.php");
}

?>