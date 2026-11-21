<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des PFEs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header class="site-header">
    <div class="header-container">
        <div class="logo-section">
            <h2 class="site-title">
                <img src="images/logo.png" alt="Logo de la plateforme" class="site-logo">
                Gestion des PFEs
            </h2>
        </div>

        <div class="user-section">
            <div class="user-info">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['nom'])) {
                    echo "Bienvenue, <span>" . $_SESSION['nom'] . " " . $_SESSION['prenom'] . "</span> <em>(" . $_SESSION['profil'] . ")</em>";
                }
                ?>

            </div>
        </div>
    </div>

    <div class="nav-divider"></div>
    <?php include("includes/nav.php"); ?>
</header>
</body>
</html>


