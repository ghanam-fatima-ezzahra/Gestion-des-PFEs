<?php
// config_db.php

// Informations de connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root";  // Nom d'utilisateur MySQL
$motDePasse = "";       // Mot de passe MySQL
$baseDD = "gestion_pfe";        // Nom de la base de données

// Établir la connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);

// Vérifier la connexion
if (!$conn) {
die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>
