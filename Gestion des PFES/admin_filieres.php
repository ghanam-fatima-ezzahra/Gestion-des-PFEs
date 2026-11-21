<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

// Supprimer
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM filieres WHERE id=$id");
}

// Ajouter ou modifier
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nom = $_POST['nom'];
    $dept_id = ($_POST['dept_id'] !== '') ? intval($_POST['dept_id']) : "NULL";
    $coord_id = ($_POST['coord_id'] !== '') ? intval($_POST['coord_id']) : "NULL";

    if ($id == 0) {
        mysqli_query($conn, "INSERT INTO filieres (nom, dept_id, coord_id) VALUES ('$nom', $dept_id, $coord_id)");
    } else {
        mysqli_query($conn, "UPDATE filieres SET nom='$nom', dept_id=$dept_id, coord_id=$coord_id WHERE id=$id");
    }
}

// Préparer pour édition
$edit = ['id' => 0, 'nom' => '', 'dept_id' => '', 'coord_id' => ''];
if (isset($_GET['edit'])) {
    $res = mysqli_query($conn, "SELECT * FROM filieres WHERE id=" . intval($_GET['edit']));
    $edit = mysqli_fetch_assoc($res);
}
?>
<?php include('includes/header.php'); ?>
<h2>Gestion des Filières</h2>

<!-- Formulaire -->
<form method="POST">
    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
    <label>Nom:</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($edit['nom']) ?>" required><br>
    <label>Département ID (facultatif):</label>
    <input type="number" name="dept_id" value="<?= htmlspecialchars($edit['dept_id']) ?>"><br>
    <label>Coordinateur ID (facultatif):</label>
    <input type="number" name="coord_id" value="<?= htmlspecialchars($edit['coord_id']) ?>"><br>
    <button type="submit"><?= $edit['id'] ? 'Modifier' : 'Ajouter' ?></button>
</form>

<hr>

<!-- Tableau -->
<table border="1">
    <tr><th>ID</th><th>Nom</th><th>Département ID</th><th>Coordinateur ID</th><th>Actions</th></tr>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM filieres");
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nom']}</td>
            <td>{$row['dept_id']}</td>
            <td>{$row['coord_id']}</td>
            <td>
                <a href='?edit={$row['id']}'>Éditer</a> |
                <a href='?delete={$row['id']}' onclick=\"return confirm('Supprimer ?')\">Supprimer</a>
            </td>
        </tr>";
    }
    ?>
</table>
<!-- Bouton de retour -->
<a href="index.php"><button>Retour à l'Accueil</button></a>
<?php require("includes/footer.html"); ?>
