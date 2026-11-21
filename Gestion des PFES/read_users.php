<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$res = mysqli_query($conn, "SELECT * FROM users");
?>

<h3>Liste des utilisateurs</h3>
<a href="admin_users.php?action=create"><button>Ajouter un utilisateur</button></a>
<table border="1">
    <tr><th>ID</th><th>Email</th><th>Mot de passe</th><th>Rôle</th><th>User ID</th><th>Actions</th></tr>
    <?php while ($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['password'] ?></td>
            <td><?= $row['role'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td>
                <a href="admin_users.php?action=update&id=<?= $row['id'] ?>">Éditer</a> |
                <a href="admin_users.php?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="index.php"><button>Retour à l'Accueil</button></a>
