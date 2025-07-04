<?php

setcookie("nombre", "bob", time()+3600*60);
// setcookie("campo", "valornNuevo");

/* Borrar cookie */
setcookie("campo", time()-1);
// el -1 agota el triempo de sesion
