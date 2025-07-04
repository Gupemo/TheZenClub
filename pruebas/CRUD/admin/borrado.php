<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    
    include './DB.php';
    $user = DB::buscarID($_GET['id']);
    echo "El usuario " . $user[0]->nombre . " Ha sido borrado";

    $usuario = DB::borrarId($_GET['id']);


    ?>
    
</body>
</html>