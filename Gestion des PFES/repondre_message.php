<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['profil']) || $_SESSION['profil'] != "Administrateur") {
    die("Accès refusé. Vous n'avez pas les permissions nécessaires.");
}

require("config_db.php");

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Récupérer les informations du message
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $req = "SELECT * FROM messages_contact WHERE id = ?";
    $stmt = $conn->prepare($req);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $message = $result->fetch_assoc();
    if (!$message) {
        die("Message introuvable.");
    }
} else {
    die("ID du message manquant.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre au message</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
<?php require("includes/header.php"); ?>
<main class="repondre-main">
    <h1>Répondre au message</h1>
    <form action="traitement_reponse.php" method="POST" class="repondre-form">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($message['email']); ?>">
        <input type="hidden" name="sujet" value="<?php echo htmlspecialchars($message['sujet']); ?>">

        <p><strong>De :</strong> <?php echo htmlspecialchars($message['nom']); ?> (<?php echo htmlspecialchars($message['email']); ?>)</p>
        <p><strong>Sujet :</strong> <?php echo htmlspecialchars($message['sujet']); ?></p>
        <p><strong>Message :</strong> <?php echo nl2br(htmlspecialchars($message['message'])); ?></p>

        <label for="reponse">Votre réponse :</label>
        <textarea id="reponse" name="reponse" rows="5" placeholder="Rédigez votre réponse ici..." required></textarea>

        <button type="submit">Envoyer la réponse</button>
    </form>
</main>
<?php require("includes/footer.html"); ?>
</body>
</html>
