<?php
require("config_db.php");

// Connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Récupérer l'ID de l'étudiant connecté
$etudiant_id = $_SESSION['id'];

// Récupérer les données du PFE de l'étudiant
$req = "SELECT * FROM pfes WHERE etudiant_id = $etudiant_id";
$res = mysqli_query($conn, $req);
$pfe = mysqli_fetch_assoc($res);

// Récupérer la liste des enseignants
$req_enseignants = "SELECT * FROM enseignants";
$res_enseignants = mysqli_query($conn, $req_enseignants);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre PFE</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body class="edit-pfe-body">
<form action="modifier_pfe.php" method="post" class="edit-pfe-form">
    <h2>Modifier votre PFE</h2>

    <!-- Afficher les messages -->
    <h3 class="edit-pfe-message">
        <?php
        echo isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
        $_SESSION['msg'] = ""; // Réinitialiser le message
        ?>
    </h3>

    <input type="hidden" name="id" value="<?php echo $pfe['id']; ?>">

    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" value="<?php echo $pfe['titre']; ?>" required>

    <label for="resume">Résumé :</label>
    <textarea id="resume" name="resume" rows="3" required><?php echo $pfe['resume']; ?></textarea>

    <label for="organisme">Organisme :</label>
    <input type="text" id="organisme" name="organisme" value="<?php echo $pfe['organisme']; ?>" required>

    <label for="encadrant_ex">Encadrant externe :</label>
    <input type="text" id="encadrant_ex" name="encadrant_ex" value="<?php echo $pfe['encadrant_ex']; ?>" required>

    <label for="email_ex">Email de l'encadrant externe :</label>
    <input type="email" id="email_ex" name="email_ex" value="<?php echo $pfe['email_ex']; ?>" required>

    <label for="encadrant_in_id">Encadrant interne :</label>
    <select id="encadrant_in_id" name="encadrant_in_id" required>
        <?php while ($enseignant = mysqli_fetch_assoc($res_enseignants)): ?>
            <option value="<?php echo $enseignant['id']; ?>"
                <?php echo ($enseignant['id'] == $pfe['encadrant_in_id']) ? "selected" : ""; ?>>
                <?php echo $enseignant['nom'] . " " . $enseignant['prenom']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit" class="btn btn-primary">Enregistrer</button>

    <a href="index.php" class="btn btn-secondary">Retour</a>
</form>
</body>
</html>




