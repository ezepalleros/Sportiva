<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$icon = "iconousuario.png";
$dropdownVisible = false;
$userEmail = "";
if (isset($_SESSION['rolUsu'])) {
    $icon = "iconousuario2.png";
    $dropdownVisible = true;
    $userEmail = $_SESSION['mailUsu'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary" style="background-color: #204C73 !important;">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a class="navbar-brand" href="../paginas/home.php">
                <img src="../img/logo.png" alt="Logo" style="max-width: 100px; height: auto;">
            </a>
            <div class="navbar-nav d-flex flex-row">
                <?php
                $paginas = array(
                    "Inicio" => "../paginas/home.php",
                    "Sobre Nosotros" => "../paginas/nosotros.php",
                    "Catálogo" => "../paginas/catalogo.php",
                    "Comentario" => "../paginas/comentarios.php"
                );

                foreach ($paginas as $pantallas => $links) {
                    echo "<a href='$links' class='nav-link text-yellow fs-4 px-3'>$pantallas</a>";
                }
                ?>
            </div>

            <div class="ms-auto position-relative">
                <?php if ($dropdownVisible): ?>
                <div class="user-info">
                    <span class="text-white"><?php echo htmlspecialchars($userEmail); ?></span>
                    <img src="../img/<?php echo $icon; ?>" alt="Usuario" style="max-width: 50px; height: auto; cursor: pointer;" id="userIcon">
                </div>
                <?php else: ?>
                <a href="../paginas/iniciosesion.php">
                    <img src="../img/<?php echo $icon; ?>" alt="Usuario" style="max-width: 50px; height: auto; cursor: pointer;" id="userIcon">
                </a>
                <?php endif; ?>

                <div id="userDropdown" class="dropdown-menu">
                    <a class="dropdown-item" href="../cuentas/logout.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </nav>
</header>
<main>