<html>
    <head>
        <title>Sesiones</title>
    </head>
    <body>
        <?php
        
        session_start();

        if(isset($_POST["enviar"])){
            if($_POST["nombre"]=="pito" && $_POST["password"]=="1111"){
                $_SESSION["nombre"]="pito";
                echo "Hola " . $_SESSION["nombre"];
            }
        }
        if(isset($_POST['salir'])){
            session_unset();
            session_destroy();
            echo "Sesion cerrada";
        }

        if(isset($_SESSION["nombre"])){

            ?>
            <a href="insertar.php">Insertar</a>
            <form action="index.php" method="POST">
                <input type="submit" value="salir" name="salir">
            </form>
            <?php
            exit();

        }

        ?>
        <form action="index.php" method="post">
            nombre: <input type="text" name="nombre">
            contraseña: <input type="password" name="password">
            <input type="submit" value="enviar" name="enviar">
            
        </form>
    </body>
</html>