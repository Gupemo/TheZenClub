<?php

session_name("sesion");
session_set_cookie_params(200);
session_start();
if(isset($_SESSION["contador"])){
    $_SESSION["contador"]++;
}else{
    $_SESSION['contador'] = 1;
}

echo $_SESSION['contador'];