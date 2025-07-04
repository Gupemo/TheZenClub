<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <?php
        session_start();

        if($_SESSION['usuario']['rol'] != "admin") {
            header('location../login.php?login=ko');
            echo "no tienes acceso";
            exit();
        }




        $id = null;
        $usuario = null;
        if($_GET['id'] != 'no') {
            $id = $_GET['id'];
            include './DB.php';
            $usuario = DB::buscarID($id);
            //print_r($usuario);
        }


        ?>
        <h1>
            <?php echo $id != null ? 'Actualización de usuario' : 'Insertar nuevo usuario' ?>
        </h1>

        <form action="./action.php" method="POST">

            <div>
                <div>
                    <label for="nuevoNombre">nombre</label>
                    <input type="text" name="nuevoNombre" value="<?php echo $id!=null?$usuario[0]->nombre:'' ?>">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $id!=null?$usuario[0]->email:'' ?>">
                </div>
                <div>
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" <?php echo $id!=null?"disabled":""?>>
                </div>

                <select name="rol">
                    <?php
                    if($id != null) {

                        
                        ?>
                    <option value="admin" <?php echo $usuario[0]->rol=="admin"?"selected":"" ?>>Admin</option>
                    <option value="user"  <?php echo $usuario[0]->rol=="admin"?"":"selected" ?>>User</option>
                    <?php
                    }else{
                        ?>
                    <option value="admin"> Admin </option>
                    <option value="user" selected> User </option>
                        <?php


                    }
                    ?>
                </select>

                <div>
                    <input type="submit" value="enviar">
                </div>

            </div>
            <div>
                <input type="hidden" name="action" value="regUsuario">
            </div>

            <?php
            if($id != NULL) {
                ?>
                <input type="hidden" name="reg-act" value="<?php echo $id ?>">

                <?php
            }else{
                ?>
                
                <input type="hidden" name="reg-act" value="<?php echo $id ?>">
                <?php

            }

            ?>



        </form>
        
    </body>
</html>