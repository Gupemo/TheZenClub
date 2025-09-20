<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerUsers.php';

$user_id = $_SESSION['user_id'];
$controlador = new ControllerUsers;

$perfil = $controlador->userProfile($user_id);
$contactos = $controlador->userContacts($user_id);

// Determinar imagen de cinturón
$cinturonImg = "/assets/belts/default.png"; // imagen por defecto
if ($perfil && $perfil->cinturon) {
    switch ($perfil->cinturon) {
        case 'Blanco':  $cinturonImg = "/assets/images/cinturon_blanco.png"; break;
        case 'Gris':    $cinturonImg = "/assets/belts/gris.png"; break;
        case 'Amarillo':$cinturonImg = "/assets/belts/amarillo.png"; break;
        case 'Naranja': $cinturonImg = "/assets/belts/naranja.png"; break;
        case 'Verde':   $cinturonImg = "/assets/belts/verde.png"; break;
        case 'Azul':    $cinturonImg = "/assets/belts/azul.png"; break;
        case 'Morado':  $cinturonImg = "/assets/belts/morado.png"; break;
        case 'Marrón':  $cinturonImg = "/assets/belts/marron.png"; break;
        case 'Negro':   $cinturonImg = "/assets/belts/negro.png"; break;
        // 👉 añade aquí las variantes que faltan
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords"
        content="escuela, bjj, jiu jitsu, jiu jitsu brasileño, brazilian jiu jitsu, las palmas, academia artes marciales, artes marciales">
    <meta name="description" content="Escuela de artes marciales, especializada en Jiu Jitsu brasileño">
    <title>The Zen Club - <?= $perfil -> user_name ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/styles/normalize.css">
    <link rel="stylesheet" href="../../assets/styles/styles.css">
    <link rel="manifest" href="../../assets/data/manifest.json">
    <link rel="icon" type="image/png" href="/assets/icons/logo.ico">
</head>

<body>
    <div class="contenedor">
        <header class="header">
            <img src="/assets/logo.png" alt="Logo del club" class="header__logo">
        </header>

        <?php include '../../includes/navBar.php'; ?>

        <main class="main">
            <section class="section profile">
                <div class="profile__card">

                    <!-- Imagen de perfil centrada -->
                    <div class="profile__image">
                        <img src="<?=$perfil->user_picture ?? '/assets/img/default.png'?>" 
                            alt="Foto de perfil" 
                            class="<?= $perfil->user_active ? 'activo' : 'inactivo' ?>">
                    </div>

                    <!-- Imagen del cinturón debajo -->
                    <div class="profile__belt">
                        <img src="<?= $cinturonImg ?>" alt="Cinturón <?= htmlspecialchars($perfil->cinturon ?? '') ?>">
                    </div>

                    <!-- Info básica en dos columnas -->
                    <div class="profile__info">
                        <div class="profile__col izquierda">
                            <small class="info">Nombre y apellidos:</small>
                            <p><?= htmlspecialchars($perfil->user_name) ?> <?= htmlspecialchars($perfil->user_subname) ?></p>
                            <small class="info">Telefono:</small>
                            <p><?= htmlspecialchars($perfil->user_phone) ?></p>
                        </div>
                        <div class="profile__col derecha">
                            <small class="info">Correo electrónico:</small>
                            <p><?= htmlspecialchars($perfil->user_email) ?></p>
                        </div>
                    </div>

                    <!-- Contactos de emergencia -->
                    <div class="profile__contacts">
                        <h3>Contactos de emergencia</h3>
                        <?php if (!empty($contactos)): ?>
                            <ul>
                                <?php foreach ($contactos as $c): ?>
                                    <li>
                                        <?= htmlspecialchars($c->nombre . ' ' . $c->apellidos) ?>
                                        (<?= htmlspecialchars($c->relacion) ?>) -
                                        <?= htmlspecialchars($c->telefono) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No hay contactos registrados.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </section>
        </main>

        <?php include '../../includes/footer.php'; ?>
    </div>

    <script src="/assets/js/hamburguesa.js"></script>
</body>
</html>
