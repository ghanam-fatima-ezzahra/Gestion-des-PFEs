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

// Récupérer les messages depuis la base de données
$req = "SELECT * FROM messages_contact ORDER BY date_envoi DESC";
$res = mysqli_query($conn, $req);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages reçus</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
<?php require("includes/header.php"); ?>
<main class="messages-main">
    <h1>Messages reçus</h1>
    <div class="messages-container">
        <?php
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<div class='message'>";
                echo "<h3>Sujet : " . htmlspecialchars($row['sujet']) . "</h3>";
                echo "<p><strong>De :</strong> " . htmlspecialchars($row['nom']) . " (" . htmlspecialchars($row['email']) . ")</p>";
                echo "<p><strong>Message :</strong> " . nl2br(htmlspecialchars($row['message'])) . "</p>";
                echo "<p><em>Envoyé le : " . htmlspecialchars($row['date_envoi']) . "</em></p>";
                // Ajouter un bouton "Répondre"
                echo "<a href='repondre_message.php?id=" . $row['id'] . "' class='btn-repondre'>Répondre</a>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Aucun message reçu pour le moment.</p>";
        }
        ?>
    </div>
</main>
<?php require("includes/footer.html"); ?>
</body>
</html>
