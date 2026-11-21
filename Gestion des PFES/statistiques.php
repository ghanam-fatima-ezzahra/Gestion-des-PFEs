<?php
require("config_db.php");

// Vérifier la connexion à la base de données
if (!$conn) {
    die("Erreur : Connexion à la base de données échouée.");
}

// Récupérer les statistiques
$totalEtudiants = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM etudiants"))['total'];
$totalEnseignants = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM enseignants"))['total'];
$totalPFEs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pfes"))['total'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Statistiques</h1>
<div class="statistiques">
    <p><strong>Nombre total d'étudiants :</strong> <?php echo $totalEtudiants; ?></p>
    <p><strong>Nombre total d'enseignants :</strong> <?php echo $totalEnseignants; ?></p>
    <p><strong>Nombre total de PFEs :</strong> <?php echo $totalPFEs; ?></p>
    <!-- Bouton Retour -->
    <a href="index.php"  >Retour</a>
</div>
</body>
</html>

