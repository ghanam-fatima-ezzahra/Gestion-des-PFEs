<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $sujet = "Réponse : " . $_POST['sujet'];
    $reponse = $_POST['reponse'];

    // Configuration de l'envoi d'email
    $headers = "From: admin@votre-site.com\r\n";
    $headers .= "Reply-To: admin@votre-site.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envoyer l'email
    if (mail($email, $sujet, $reponse, $headers)) {
        header("Location: admin_messages.php?msg=Réponse envoyée avec succès");
        exit();
    } else {
        echo "Erreur lors de l'envoi de l'email.";
    }
} else {
    die("Requête invalide.");
}
?>
<!-- Bouton Retour -->
<a href="admin_messages.php"  >Retour</a>
