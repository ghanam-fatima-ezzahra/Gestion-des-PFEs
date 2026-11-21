<?php
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

// Récupérer l'ID du PFE à modifier
$pfe_id = intval($_GET['id']);

// Récupérer les données du PFE
$query = "SELECT * FROM pfes WHERE id = $pfe_id";
$result = mysqli_query($conn, $query);
$pfe = mysqli_fetch_assoc($result);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Échapper les caractères spéciaux
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $resume = mysqli_real_escape_string($conn, $_POST['resume']);
    $organisme = mysqli_real_escape_string($conn, $_POST['organisme']);

    // Mettre à jour les données du PFE
    $update_query = "UPDATE pfes SET titre = '$titre', resume = '$resume', organisme = '$organisme' WHERE id = $pfe_id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: encadrement_prof.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un PFE</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body class="modifier-pfe-body">
<div class="modifier-pfe-container">
    <h2>Modifier le PFE</h2>
    <form method="POST" class="modifier-pfe-form">
        <label for="titre">Titre :</label>
        <input
                type="text"
                id="titre"
                name="titre"
                value="<?= $pfe['titre'] ?>"
                required
        >

        <label for="resume">Résumé :</label>
        <textarea
                id="resume"
                name="resume"
                rows="4"
                required
        ><?= $pfe['resume'] ?></textarea>

        <label for="organisme">Organisme :</label>
        <input
                type="text"
                id="organisme"
                name="organisme"
                value="<?= $pfe['organisme'] ?>"
                required
        >

        <button type="submit">Enregistrer</button>
    </form>
    <div class="modifier-pfe-back">
        <a href="encadrement_prof.php">Retour</a>
    </div>
</div>
</body>
</html>