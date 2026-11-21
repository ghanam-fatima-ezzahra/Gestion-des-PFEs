<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM users WHERE id = $id");
header("Location: admin_users.php?action=read");
exit();
?>
