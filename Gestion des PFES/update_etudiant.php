<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM etudiants WHERE id = $id");
$edit = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mat = $_POST['matricule'];
    $promo = $_POST['promotion'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $fil_id = intval($_POST['fil_id']);

    $query = "UPDATE etudiants SET matricule = '$mat', promotion = '$promo', nom = '$nom', prenom = '$prenom', 
              tel = '$tel', email = '$email', fil_id = $fil_id WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: admin_etudiants.php?action=read");
    exit();
}
?>

<h3>Modifier un étudiant</h3>

<form method="POST">
    <label>Matricule :</label><br>
    <input name="matricule" value="<?= $edit['matricule'] ?>" required><br><br>

    <label>Promotion :</label><br>
    <input name="promotion" value="<?= $edit['promotion'] ?>" required><br><br>

    <label>Nom :</label><br>
    <input name="nom" value="<?= $edit['nom'] ?>" required><br><br>

    <label>Prénom :</label><br>
    <input name="prenom" value="<?= $edit['prenom'] ?>" required><br><br>

    <label>Téléphone :</label><br>
    <input name="tel" value="<?= $edit['tel'] ?>" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" value="<?= $edit['email'] ?>" required><br><br>

    <label>Filière ID :</label><br>
    <input type="number" name="fil_id" value="<?= $edit['fil_id'] ?>" required><br><br>

    <button type="submit">Modifier</button>
</form>

<br>

<a href="admin_etudiants.php?action=read"><button>Retour</button></a>
