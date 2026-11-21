<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION["profil"]) || $_SESSION["profil"] != "Administrateur") {
    header("location:index.php");
    exit();
}

require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

// Ajout ou modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $id = $_POST['id'];

    if ($id == "") {
        $stmt = mysqli_prepare($conn, "INSERT INTO departements (nom) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $nom);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE departements SET nom=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "si", $nom, $id);
    }

    mysqli_stmt_execute($stmt);
    header("Location: admin_departements.php");
    exit();
}

// Suppression
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM departements WHERE id=$id");
    header("Location: admin_departements.php");
    exit();
}

// Chargement pour édition
$edit = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM departements WHERE id=$id");
    $edit = mysqli_fetch_assoc($res);
}


?>
<?php include('includes/header.php'); ?>
<h2>Gestion des Départements</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $edit ? $edit['id'] : '' ?>">
    <input type="text" name="nom" placeholder="Nom du département" required value="<?= $edit ? htmlspecialchars($edit['nom']) : '' ?>">
    <button type="submit"><?= $edit ? "Modifier" : "Ajouter" ?></button>
</form>

<hr>

<table border="1">
    <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM departements");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nom']}</td>
                <td>
                    <a href='admin_departements.php?edit={$row['id']}'>Modifier</a> |
                    <a href='admin_departements.php?delete={$row['id']}' onclick='return confirm(\"Supprimer ce département ?\")'>Supprimer</a>
                </td>
              </tr>";
    }
    ?>
</table>
<!-- Bouton de retour -->
<a href="index.php"><button>Retour à l'Accueil</button></a>
<?php require("includes/footer.html"); ?>


