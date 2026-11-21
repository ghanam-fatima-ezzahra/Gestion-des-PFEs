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

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Échapper les données pour éviter les injections SQL
    $id = intval($_POST['id']);
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $resume = mysqli_real_escape_string($conn, $_POST['resume']);
    $organisme = mysqli_real_escape_string($conn, $_POST['organisme']);
    $encadrant_ex = mysqli_real_escape_string($conn, $_POST['encadrant_ex']);
    $email_ex = mysqli_real_escape_string($conn, $_POST['email_ex']);
    $encadrant_in_id = intval($_POST['encadrant_in_id']);

    // Requête SQL pour mettre à jour le PFE
    $req = "UPDATE pfes 
            SET titre = '$titre', 
                resume = '$resume', 
                organisme = '$organisme', 
                encadrant_ex = '$encadrant_ex', 
                email_ex = '$email_ex', 
                encadrant_in_id = $encadrant_in_id 
            WHERE id = $id";

    // Exécuter la requête
    if (mysqli_query($conn, $req)) {
        $_SESSION['msg'] = "PFE modifié avec succès.";
    } else {
        $_SESSION['msg'] = "Erreur lors de la modification : " . mysqli_error($conn);
    }

    // Redirection vers la page d'édition
    header('Location: editer_pfe.php');
    exit();
}
?>



