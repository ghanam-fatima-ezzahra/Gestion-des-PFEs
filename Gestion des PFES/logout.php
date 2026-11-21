<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();}
$_SESSION = array(); // Vide toutes les variables de session
session_destroy();
header("Location: index.php");
exit();
?>

