<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$user = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $user_id = ($_POST['user_id'] !== '') ? intval($_POST['user_id']) : "NULL";

    $query = "UPDATE users SET email = '$email', password = '$password', role = '$role', user_id = $user_id WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: admin_users.php?action=read");
    exit();
}
?>

<h3>Modifier un utilisateur</h3>
<form method="POST">
    <input placeholder="Email" type="email" name="email" value="<?= $user['email'] ?>" required>
    <input placeholder="Mot de passe" type="password" name="password" value="<?= $user['password'] ?>" required>
    <select name="role" required>
        <option value="Etudiant" <?= $user['role'] == "Etudiant" ? "selected" : "" ?>>Étudiant</option>
        <option value="Enseignant" <?= $user['role'] == "Enseignant" ? "selected" : "" ?>>Enseignant</option>
        <option value="Administrateur" <?= $user['role'] == "Administrateur" ? "selected" : "" ?>>Administrateur</option>
        <option value="Visiteur" <?= $user['role'] == "Visiteur" ? "selected" : "" ?>>Visiteur</option>
    </select>
    <input placeholder="User ID (facultatif)" type="number" name="user_id" value="<?= $user['user_id'] ?>">
    <button type="submit">Mettre à jour</button>
</form>
<a href="admin_users.php?action=read"><button>Retour</button></a>

