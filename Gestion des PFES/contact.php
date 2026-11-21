<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("includes/header.php");
?>
<main class="contact-main">
    <h1>Contactez-nous</h1>
    <form action="traitement_contact.php" method="POST" class="contact-form">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>

        <label for="sujet">Sujet :</label>
        <input type="text" id="sujet" name="sujet" placeholder="Sujet de votre message" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="5" placeholder="Votre message" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</main>
<?php
require("includes/footer.html");
?>
</body>
</html>
