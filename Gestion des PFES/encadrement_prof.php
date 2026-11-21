<?php
require("includes/header.php");
require("config_db.php");

// Connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et est un enseignant
if (!isset($_SESSION["profil"]) || $_SESSION["profil"] !== "Enseignant") {
    header("location:index.php");
    exit();
}

// Récupérer l'ID de l'enseignant connecté
$prof_id = $_SESSION["id"];

// Récupérer les PFE encadrés par cet enseignant
$query = "SELECT * FROM pfes WHERE encadrant_in_id = $prof_id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encadrement des PFE</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
<h2 class="page-title">Liste des PFE que vous encadrez</h2>

<!-- Afficher les PFE -->
<table class="pfe-table">
    <tr class="table-header">
        <th>ID</th>
        <th>Titre</th>
        <th>Résumé</th>
        <th>Organisme</th>
        <th>Rapport</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr class="<?= $row['id'] % 2 == 0 ? 'table-row-even' : 'table-row-odd'; ?>">
            <td><?= $row['id'] ?></td>
            <td><?= $row['titre'] ?></td>
            <td><?= $row['resume'] ?></td>
            <td><?= $row['organisme'] ?></td>
            <td>
                <?php if (!empty($row['rapport'])): ?>
                    <a href="rapports/<?= $row['rapport'] ?>" target="_blank" class="rapport-link">Voir le rapport</a>
                <?php else: ?>
                    Aucun rapport
                <?php endif; ?>
            </td>
            <td>
                <a href="modifier_pfe_prof.php?id=<?= $row['id'] ?>" class="action-link">Modifier</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php
require("includes/footer.html");
?>
</body>
</html>


