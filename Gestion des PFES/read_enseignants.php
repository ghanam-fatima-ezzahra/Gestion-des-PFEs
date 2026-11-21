<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$res = mysqli_query($conn, "SELECT * FROM enseignants");
?>

<h3>Liste des enseignants</h3>
<a href="admin_enseignants.php?action=create"><button>Ajouter un enseignant</button></a>
<table border="1">
    <tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Dépt ID</th><th>Actions</th></tr>
    <?php while ($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nom'] ?></td>
            <td><?= $row['prenom'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['dept_id'] ?></td>
            <td>
                <a href="admin_enseignants.php?action=update&id=<?= $row['id'] ?>">Éditer</a> |
                <a href="admin_enseignants.php?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="index.php"><button>Retour à l'Accueil</button></a>
