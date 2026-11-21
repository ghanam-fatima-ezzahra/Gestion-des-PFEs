<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$res = mysqli_query($conn, "SELECT * FROM etudiants");
?>

<h3>Liste des étudiants</h3>
<a href="create_etudiant.php"><button>Ajouter un étudiant</button></a>
<table border="1">
    <tr><th>ID</th><th>Matricule</th><th>Nom</th><th>Email</th><th>Actions</th></tr>
    <?php while ($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['matricule'] ?></td>
            <td><?= $row['nom'] . " " . $row['prenom'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="update_etudiant.php?id=<?= $row['id'] ?>">Éditer</a> |
                <a href="delete_etudiant.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="index.php"><button>Retour à l'Accueil</button></a>
