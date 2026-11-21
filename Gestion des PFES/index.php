

<?php
include("includes/header.php");
?>

<main class="main-content">
    <h1>Bienvenue sur la plateforme de Gestion des PFEs</h1>

    <section class="intro-section">
        <p>Cette plateforme permet de gérer les Projets de Fin d'Études des étudiants.</p>
        <p>📚 <strong>Objectif :</strong> Appliquer les connaissances théoriques et acquérir une expérience pratique.</p>
        <p>🕒 <strong>Durée :</strong> 6 mois | <strong>Procédure :</strong> Validation par l'encadrant, soutenance finale.</p>
    </section>

    <!-- 🔎 Barre de recherche -->
    <form method="GET" action="recherche_pfe.php" class="search-form">
        <input type="text" name="query" placeholder="Rechercher un PFE..." required class="search-input">
        <button type="submit" class="search-button">🔎 Rechercher</button>
    </form>

    <p>
        <a href="login.php" class="btn-connect" aria-label="Se connecter pour accéder aux informations">👉 Connectez-vous</a> pour accéder à vos informations.
    </p>
</main>

<?php include('includes/footer.html'); ?>



