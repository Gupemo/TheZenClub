<?php

/**
 * Menú dinamico segun roles de usuario.
 */

// inicio sesion
session_start();

// obtener página actual

$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$menuDefault = [
    '/index.php'                => 'Inicio',
    '/views/profesores.php'     => 'Profesores',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    '/views/noticias.php'       => 'Noticias'
];

$menuUsuario = [
    '/index.php'                => 'Inicio',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    'views/noticias.php'        => 'Noticias',
    '/views/perfil.php'         => 'perfil',
    '/views/logout.php'         => 'Cerrar sesión'
];

$menuProfesores = [
    '/index.php'                => 'Inicio',
    '/views/profesores.php'     => 'profesores',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    'views/noticias.php'        => 'Noticias',
    '/views/perfil.php'         => 'perfil',
    '/admin/panel_profesor'     => 'Panel de profesor',
    '/views/logout.php'         => 'Cerrar sesión'
];

$menuAdministracion = [
    '/index.php'                => 'Inicio',
    '/views/profesores.php'     => 'profesores',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    'views/noticias.php'        => 'Noticias',
    '/views/perfil.php'         => 'perfil',
    '/admin/admin_panel'        => 'Panel de administración',
    '/views/logout.php'         => 'Cerrar sesión'
];

// Seleccionando el menú por defecto
$menuActual = $menuDefault;

// switch para cambiar el menú dependiendo del rol del usuario.
if (isset($_SESSION['usuario'])) {
    $rol = $_SESSION['usuario']['rol'];

    switch ($rol) {
        case 1:
            $menuActual = $menuUsuario;
            break;
        case 2:
            $menuActual = $menuProfesores;
            break;
        case 3:
            $menuActual = $menuProfesores;
            break;
        case 4:
            $menuActual = $menuAdministracion;
            break;
    }
}
?>

<nav class="nav">
    <button class="nav__toggle" aria-label="Abrir menú">☰</button>
    <ul class="nav__menu">
<?php foreach ($menuActual as $url => $nombre): 
    $isCurrent = ($current === $url) || ($url === '/index.php' && $current === '/');
?>
    <li>
        <a href="<?= $url ?>" class="<?= $isCurrent ? 'nav__menu--actual' : '' ?>">
            <?= $nombre ?>
        </a>
    </li>
<?php endforeach; ?>

    </ul>
</nav>