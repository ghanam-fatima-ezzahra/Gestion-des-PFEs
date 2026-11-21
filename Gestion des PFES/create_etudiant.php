<?php
require("config_db.php");

// Connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mat = $_POST['matricule'];
    $promo = $_POST['promotion'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $fil_id = intval($_POST['fil_id']);

    // Requête d'insertion
    $query = "INSERT INTO etudiants (matricule, promotion, nom, prenom, tel, email, fil_id) 
              VALUES ('$mat', '$promo', '$nom', '$prenom', '$tel', '$email', $fil_id)";
    if (mysqli_query($conn, $query)) {
        header("Location: admin_etudiants.php"); // Redirection après insertion
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
    <title>Ajouter un étudiant</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">

<div style="max-width: 500px; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <h3 style="text-align: center;">Ajouter un étudiant</h3>
    <form method="POST" action="">
        <label>Matricule</label><br>
        <input type="text" name="matricule" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Promotion</label><br>
        <input type="text" name="promotion" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Nom</label><br>
        <input type="text" name="nom" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Prénom</label><br>
        <input type="text" name="prenom" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Téléphone</label><br>
        <input type="tel" name="tel" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Email</label><br>
        <input type="email" name="email" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Filière ID</label><br>
        <input type="number" name="fil_id" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 3px;">Ajouter</button>

        <a href="admin_etudiants.php"><button type="button">Retour</button></a>

    </form>

</div>

</body>
</html>
