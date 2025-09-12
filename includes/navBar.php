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
    '/views/noticias.php'       => 'Noticias',
    '/views/login.php'          => 'Iniciar sesión'
];

$menuUsuario = [
    '/index.php'                => 'Inicio',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    'views/noticias.php'        => 'Noticias',
    '/views/users/profile.php'  => 'perfil',
    '/views/logout.php'         => 'Cerrar sesión'
];

$menuProfesores = [
    '/index.php'                => 'Inicio',
    '/views/profesores.php'     => 'profesores',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    'views/noticias.php'        => 'Noticias',
    '/views/users/profile.php'  => 'perfil',
    '/admin/index.php'          => 'Panel de profesor',
    '/views/logout.php'         => 'Cerrar sesión'
];

$menuAdministracion = [
    '/index.php'                => 'Inicio',
    '/views/profesores.php'     => 'profesores',
    '/views/horarios.php'       => 'Horarios',
    '/views/nosotros.php'       => 'Sobre nosotros',
    'views/noticias.php'        => 'Noticias',
    '/views/users/profile.php'  => 'perfil',
    '/admin/index.php'          => 'Panel de administración',
    '/views/logout.php'         => 'Cerrar sesión'
];

// Seleccionando el menú por defecto
$menuActual = $menuDefault;

// switch para cambiar el menú dependiendo del rol del usuario.
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];

    switch ($rol) {
        case 1:
            $menuActual = $menuUsuario;
            break;
        case 2:
            $menuActual = $menuProfesores;
            break;
        case 3:
        case 4:
            $menuActual = $menuProfesores;
            break;
        default:
            $menuActual = $menuUsuario;
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