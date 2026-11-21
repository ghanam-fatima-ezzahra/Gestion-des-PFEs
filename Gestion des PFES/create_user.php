<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $user_id = ($_POST['user_id'] !== '') ? intval($_POST['user_id']) : "NULL";

    $query = "INSERT INTO users (email, password, role, user_id) VALUES ('$email', '$password', '$role', $user_id)";
    mysqli_query($conn, $query);
    header("Location: admin_users.php?action=read");
    exit();
}
?>

<h3>Ajouter un utilisateur</h3>
<form method="POST" style="max-width: 400px; margin: auto;">
    <div style="margin-bottom: 10px;">
        <label for="email">Email :</label><br>
        <input type="email" name="email" id="email" placeholder="Email" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="role">Rôle :</label><br>
        <select name="role" id="role" required style="width: 100%;">
            <option value="Etudiant">Étudiant</option>
            <option value="Enseignant">Enseignant</option>
            <option value="Administrateur">Administrateur</option>
            <option value="Visiteur">Visiteur</option>
        </select>
    </div>

    <div style="margin-bottom: 10px;">
        <label for="user_id">User ID (facultatif) :</label><br>
        <input type="number" name="user_id" id="user_id" placeholder="User ID (facultatif)" style="width: 100%;">
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <button type="submit">Ajouter</button>
    </div>
</form>


<a href="admin_users.php?action=read"><button>Retour</button></a>
