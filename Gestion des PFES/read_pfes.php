<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$res = mysqli_query($conn, "SELECT * FROM pfes");
?>

<?php include('includes/header.php'); ?>
<h2>Liste des PFEs</h2>
<a href="create_pfe.php"><button>Ajouter un PFE</button></a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Étudiant ID</th>
        <th>Titre</th>
        <th>Résumé</th>
        <th>Organisme</th>
        <th>Encadrant Externe</th>
        <th>Email Externe</th>
        <th>Encadrant Interne ID</th>
        <th>Rapport</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['etudiant_id']) ?></td>
            <td><?= htmlspecialchars($row['titre']) ?></td>
            <td><?= htmlspecialchars($row['resume']) ?></td>
            <td><?= htmlspecialchars($row['organisme']) ?></td>
            <td><?= htmlspecialchars($row['encadrant_ex']) ?></td>
            <td><?= htmlspecialchars($row['email_ex']) ?></td>
            <td><?= htmlspecialchars($row['encadrant_in_id']) ?></td>
            <td>
                <?php if ($row['rapport']): ?>
                    <a href="rapports/<?= htmlspecialchars($row['rapport']) ?>" target="_blank">Voir</a>
                <?php else: ?>
                    Aucun
                <?php endif; ?>
            </td>
            <td>
                <a href="update_pfe.php?id=<?= $row['id'] ?>">Éditer</a> |
                <a href="delete_pfe.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer ce PFE ?')">Supprimer</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

