<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ruta actual (sin query string)
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$menuProfesor = [
    "Inicio" => "/admin/index.php",
    "Gestión de Invitaciones" => [
        "Invitar usuarios"      => "/admin/pages/invites.php?action=invitar",
        "Lista de invitaciones" => "/admin/pages/invites.php?action=listarInvitaciones"
    ],
    "Cuotas" => [
        "Lista de cuotas"       => "/admin/pages/cuotas.php?action=listar",
        "Cuotas pagadas"        => "/admin/pages/cuotas.php?action=pagosok",
        "Cuotas pendientes"     => "/admin/pages/cuotas.php?action=pagospendientes",
        "Asignar cuotas"        => "/admin/pages/cuotas.php?action=asignarCuotas"
    ],
    "usuarios" => [
        "Lista de usuarios" => "/admin/pages/users.php?action=listar",
        "Usuarios inactivos" => "/admin/pages/users.php?action=listarInactivos",
        "Borrar usuario" => "/admin/pages/users.php?action=borrarUsuario",
    ]
];

$menuMaestro = $menuProfesor; // mismo menú de ejemplo
$menuActual = [];

// Selección según rol
if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
    switch ($rol) {
        case 2:
        case 3:
            $menuActual = $menuProfesor;
            break;
        case 4:
            $menuActual = $menuMaestro;
            break;
        default:
            $menuActual = $menuProfesor;
            break;
    }
}

/**
 * Comprueba si dentro de un submenú hay una ruta activa
 */
function submenuHasActive($items, $current): bool {
    foreach ($items as $value) {
        if (is_array($value)) {
            if (submenuHasActive($value, $current)) {
                return true;
            }
        } else {
            $valuePath = parse_url($value, PHP_URL_PATH);
            if ($valuePath === $current) {
                return true;
            }
        }
    }
    return false;
}

/**
 * Renderiza el menú recursivamente
 * 🔹 Si un hijo está activo, solo se marca el summary padre.
 */
function renderMenu($items, $current, $isSubmenu = false) {
    echo "<ul>";
    foreach ($items as $label => $value) {
        if (is_array($value)) {
            $isActiveParent = submenuHasActive($value, $current);
            $openAttr = $isActiveParent ? " open" : "";
            $parentClass = $isActiveParent ? " class='active-parent'" : "";
            echo "<li>";
            echo "<details$openAttr>";
            echo "<summary$parentClass>" . htmlspecialchars($label) . "</summary>";
            renderMenu($value, $current, true);
            echo "</details>";
            echo "</li>";
        } else {
            $valuePath = parse_url($value, PHP_URL_PATH);
            // 🔹 Solo marcar enlaces de primer nivel
            $activeClass = (!$isSubmenu && $valuePath === $current) ? " class='active'" : "";
            echo "<li><a href='" . htmlspecialchars($value) . "'$activeClass>" . htmlspecialchars($label) . "</a></li>";
        }
    }
    echo "</ul>";
}
?>

<!-- Salida HTML -->
<details class="menu">
  <summary>☰ Menú</summary>
  <nav class="navbar">
      <?php renderMenu($menuActual, $current); ?>
  </nav>
</details>
