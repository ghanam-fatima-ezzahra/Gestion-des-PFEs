<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<nav class="main-nav">
    <a href="index.php" class="nav-link">Accueil</a> ---

    <?php if (isset($_SESSION['profil'])): ?>

        <?php if ($_SESSION['profil'] == "Etudiant"): ?>
            <a href="pfe_etudiant.php" class="nav-link">Mon PFE</a> ---
            <a href="contact.php" class="nav-link">Contact</a> ---
            <a href="faq.php" class="nav-link">FAQ</a> ---
        <?php endif; ?>

        <?php if ($_SESSION['profil'] == "Enseignant"): ?>
            <a href="encadrement_prof.php" class="nav-link">Encadrement</a> ---
        <?php endif; ?>

        <?php if ($_SESSION['profil'] == "Administrateur"): ?>
            <a href="admin_departements.php" class="nav-link">Départements</a> ---
            <a href="admin_filieres.php" class="nav-link">Filières</a> ---
            <a href="admin_enseignants.php" class="nav-link">Enseignants</a> ---
            <a href="admin_etudiants.php" class="nav-link">Étudiants</a> ---
            <a href="admin_pfes.php" class="nav-link">PFEs</a> ---
            <a href="admin_users.php" class="nav-link">Utilisateurs</a> ---
            <a href="admin_roles.php" class="nav-link">Roles</a> ---
            <a href="admin_messages.php" class="nav-link">Messages reçus</a> ---
            <a href="statistiques.php" class="nav-link">Statistiques</a> ---
        <?php endif; ?>

        <a href="logout.php" class="nav-link logout-link">Déconnexion</a> ---

    <?php else: ?>
        <a href="login.php" class="nav-link">Connexion</a> ---
    <?php endif; ?>



    <hr>
</nav>








