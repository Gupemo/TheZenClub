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
    //para ver el array: print_r($user);
    echo $user[0]->nombre;
    echo $user[0]->email;

    ?>
</body>
</html>