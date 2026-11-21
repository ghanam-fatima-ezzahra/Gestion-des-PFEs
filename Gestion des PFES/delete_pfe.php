<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "DELETE FROM pfes WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
header("Location: read_pfes.php");
exit();
?>
