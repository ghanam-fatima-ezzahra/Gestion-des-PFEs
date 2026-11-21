<?php
require("config_db.php");

// Connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $dept_id = ($_POST['dept_id'] !== '') ? intval($_POST['dept_id']) : "NULL";

    // Requête d'insertion
    $query = "INSERT INTO enseignants (nom, prenom, email, dept_id) VALUES ('$nom', '$prenom', '$email', $dept_id)";
    if (mysqli_query($conn, $query)) {
        // Redirection après succès
        header("Location: admin_enseignants.php?action=read");
        exit();
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un enseignant</title>
</head>
<body>
<h2>Ajouter un enseignant</h2>
<form method="POST">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Prénom :</label><br>
    <input type="text" name="prenom" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Département ID :</label><br>
    <input type="number" name="dept_id"><br><br>

    <button type="submit">Ajouter</button>

</form>
</body>
</html>
