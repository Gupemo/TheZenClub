<?php

setcookie(
    $clave = "Visitas", 
    $valor = 0,
    $expira = 0, // 0 Cuando cierre el navegador.
    $ruta = "/",
    $dominio = "localhost",
    $segure = true,
    $solohttps = true,
);