<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Questions Fréquentes</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("includes/header.php");
?>
<main class="faq-main">
    <h1>FAQ - Questions Fréquentes</h1>
    <div class="faq-container">
        <h2>Questions générales</h2>
        <div class="faq-item">
            <h3>Comment puis-je me connecter à mon compte ?</h3>
            <p>Pour vous connecter, cliquez sur le bouton "Connexion" dans le menu principal et entrez vos identifiants.</p>
        </div>
        <div class="faq-item">
            <h3>Que faire si j'ai oublié mon mot de passe ?</h3>
            <p>Contactez l'administrateur pour réinitialiser votre mot de passe.</p>
        </div>

        <h2>Questions sur les PFE</h2>
        <div class="faq-item">
            <h3>Comment ajouter mon PFE ?</h3>
            <p>Une fois connecté en tant qu'étudiant, cliquez sur "Mon PFE" dans le menu principal, puis sur "Ajouter PFE".</p>
        </div>
        <div class="faq-item">
            <h3>Comment modifier les informations de mon PFE ?</h3>
            <p>Accédez à la page "Mon PFE", puis cliquez sur "Modifier PFE".</p>
        </div>

        <h2>Support technique</h2>
        <div class="faq-item">
            <h3>Qui contacter en cas de problème technique ?</h3>
            <p>Vous pouvez utiliser la page de contact pour signaler un problème ou poser une question.</p>
        </div>
    </div>
</main>
<?php
require("includes/footer.html");
?>
</body>
</html>
