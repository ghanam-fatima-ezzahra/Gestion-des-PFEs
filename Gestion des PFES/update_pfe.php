<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "SELECT * FROM pfes WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$edit = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $resume = $_POST['resume'];
    $organisme = $_POST['organisme'];
    $etudiant_id = intval($_POST['etudiant_id']);
    $encadrant_ex = $_POST['encadrant_ex'];
    $email_ex = $_POST['email_ex'];
    $encadrant_in_id = intval($_POST['encadrant_in_id']);
    $rapport = $_POST['rapport'];

    $stmt = mysqli_prepare($conn, "UPDATE pfes SET titre = ?, resume = ?, organisme = ?, etudiant_id = ?, encadrant_ex = ?, email_ex = ?, encadrant_in_id = ?, rapport = ? 
                                   WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssissisi", $titre, $resume, $organisme, $etudiant_id, $encadrant_ex, $email_ex, $encadrant_in_id, $rapport, $id);
    mysqli_stmt_execute($stmt);
    header("Location: read_pfes.php");
    exit();
}
?>

<?php include('includes/header.php'); ?>
<h2>Modifier un PFE</h2>
<form method="POST">
    <label>Titre:</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($edit['titre']) ?>" required><br>

    <label>Résumé:</label>
    <textarea name="resume" required><?= htmlspecialchars($edit['resume']) ?></textarea><br>

    <label>Organisme:</label>
    <input type="text" name="organisme" value="<?= htmlspecialchars($edit['organisme']) ?>" required><br>

    <label>Étudiant ID:</label>
    <input type="number" name="etudiant_id" value="<?= htmlspecialchars($edit['etudiant_id']) ?>" required><br>

    <label>Encadrant externe:</label>
    <input type="text" name="encadrant_ex" value="<?= htmlspecialchars($edit['encadrant_ex']) ?>" required><br>

    <label>Email encadrant externe:</label>
    <input type="email" name="email_ex" value="<?= htmlspecialchars($edit['email_ex']) ?>" required><br>

    <label>Encadrant interne ID:</label>
    <input type="number" name="encadrant_in_id" value="<?= htmlspecialchars($edit['encadrant_in_id']) ?>" required><br>

    <label>Rapport (chemin):</label>
    <input type="text" name="rapport" value="<?= htmlspecialchars($edit['rapport']) ?>"><br>

    <button type="submit">Modifier</button>
</form>
<a href="read_pfes.php"><button>Retour</button></a>

