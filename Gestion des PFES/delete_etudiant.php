<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM etudiants WHERE id = $id");
header("Location: read_etudiants.php");
exit();
?>
