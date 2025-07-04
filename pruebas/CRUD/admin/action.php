<?php

if($_POST['action'] == 'regUsuario') {
    //Insertar nuevo usuario
    if(isset($_POST['reg-ins'])){
        echo "insertará " . $_POST['reg-ins'];

    }
    //actualizar usuario
    if(isset($_POST['reg-act'])){
        echo "actualizará" . $_POST['reg-act'];

    }
}