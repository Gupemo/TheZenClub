<?php
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$menu = [
    '/index.php'            => 'Inicio',
    '/pages/registro.php'   => 'Registro',
    '/pages/nosotros.php'   => 'Sobre nosotros',
    '/pages/horarios.php'   => 'Horarios'
];

// variables para SEO
if (!isset($title)) {
    $title = "The Zen Club";
}
if (!isset($description)) {
    $description = "Escuela de artes marciales";
}
if (!isset($keywords)) {
    $keywords = "artes marciales, jiu jitsu, jiu jitsu brasileño, bjj, islas canarias";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="<?= htmlspecialchars($keywords)?>">
    <meta name="description" content="<?= htmlspecialchars($description)?>">
    <title><?= htmlspecialchars($title)?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/assets/normalize.css">
    <link rel="stylesheet" href="/assets/styles/styles.css">

</head>
<body>
    <div class="contenedor">
        <header class="header">
            <img src="/assets/logo.png" alt="Logo del club" class="header__logo">
        </header>
        <nav class="nav">
            <button class="nav__toggle" aria-label="Abrir menú">☰</button>
            <ul class="nav__menu">
                <?php foreach($menu as $file => $name): 
                    $isCurrent = ($current === $file) || ($file === '/index.php' && $current === '/');
                    ?>
                <li>
                    <a href="<?= $file ?>" class="<?= $isCurrent ? 'nav__menu--actual' : '' ?>">
                        <?= $name?>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </nav>
