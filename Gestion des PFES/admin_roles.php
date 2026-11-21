<?php
require("config_db.php");

// Connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

// Suppression d'un rôle
if (isset($_GET['delete'])) {
    $role = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM roles WHERE role='$role'");
}

// Insertion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $role = $_POST['role'];
    mysqli_query($conn, "INSERT INTO roles (role) VALUES ('$role')");
}

// Mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {
    $ancien_role = $_POST['ancien_role'];  // Le rôle à remplacer
    $nouveau_role = $_POST['role'];        // Le nouveau rôle
    mysqli_query($conn, "UPDATE roles SET role='$nouveau_role' WHERE role='$ancien_role'");
}

// Récupération
$result = mysqli_query($conn, "SELECT * FROM roles");

// Préparation à l'édition
$role_edit = "";
if (isset($_GET['edit'])) {
    $role_edit = $_GET['edit'];
}
?>
<?php include('includes/header.php'); ?>
<h2>Gestion des rôles</h2>

<!-- Formulaire d'ajout / modification -->
<form method="POST">
    <?php if ($role_edit): ?>
        <input type="hidden" name="ancien_role" value="<?= $role_edit ?>">
    <?php endif; ?>
    <label>Rôle:</label>
    <input type="text" name="role" value="<?= $role_edit ?>" required>
    <?php if ($role_edit): ?>
        <button type="submit" name="modifier">Modifier</button>
    <?php else: ?>
        <button type="submit" name="ajouter">Ajouter</button>
    <?php endif; ?>
</form>

<hr>

<!-- Affichage des rôles -->
<table border="1">
    <tr><th>Rôle</th><th>Actions</th></tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['role'] ?></td>
            <td>
                <a href="?edit=<?= $row['role'] ?>">Éditer</a> |
                <a href="?delete=<?= $row['role'] ?>" onclick="return confirm('Supprimer ce rôle ?')">Supprimer</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<!-- Bouton de retour -->
<a href="index.php"><button>Retour à l'Accueil</button></a>
<?php require("includes/footer.html"); ?>



