<?php

setcookie("nombre", "pitoman", time()+3000000);

if(isset($_COOKIE["nombre"])){

    echo "su nombre es" . $_COOKIE["nombre"];

}