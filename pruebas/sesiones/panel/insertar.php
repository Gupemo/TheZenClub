
<html>
    <head>

    </head>
    <body>
        <?php

        session_start();
        if(!isset($_SESSION["nombre"])){
            echo "No estás autorizado a entrar aquí.";
            exit("<br> Fin del script");
        }

        ?>

        <h1>Insertar</h1>
        
    </body>
</html>
