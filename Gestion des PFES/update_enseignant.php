<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM enseignants WHERE id = $id");
$enseignant = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $dept_id = ($_POST['dept_id'] !== '') ? intval($_POST['dept_id']) : "NULL";

    $query = "UPDATE enseignants SET nom = '$nom', prenom = '$prenom', email = '$email', dept_id = $dept_id WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: admin_enseignants.php?action=read");
    exit();
}
?>
<form method="POST">
    <label>Nom</label><br>
    <input type="text" name="nom" value="<?= $enseignant['nom'] ?>" required><br>
    <label>Prénom</label><br>
    <input type="text" name="prenom" value="<?= $enseignant['prenom'] ?>" required><br>
    <label>Email</label><br>
    <input type="email" name="email" value="<?= $enseignant['email'] ?>" required><br>
    <label>Département ID</label><br>
    <input type="number" name="dept_id" value="<?= $enseignant['dept_id'] ?>"><br>
    <button type="submit">Modifier</button>
</form>
