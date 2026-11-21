<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) die("Erreur de connexion");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $resume = $_POST['resume'];
    $organisme = $_POST['organisme'];
    $etudiant_id = intval($_POST['etudiant_id']);
    $encadrant_ex = $_POST['encadrant_ex'];
    $email_ex = $_POST['email_ex'];
    $encadrant_in_id = intval($_POST['encadrant_in_id']);
    $rapport = $_POST['rapport'];

    $stmt = mysqli_prepare($conn, "INSERT INTO pfes (titre, resume, organisme, etudiant_id, encadrant_ex, email_ex, encadrant_in_id, rapport) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssissis", $titre, $resume, $organisme, $etudiant_id, $encadrant_ex, $email_ex, $encadrant_in_id, $rapport);
    mysqli_stmt_execute($stmt);
    header("Location: admin_pfes.php");
    exit();
}
?>


<h2>Ajouter un PFE</h2>
<form method="POST" style="max-width: 600px; margin: auto;">
    <div style="margin-bottom: 10px;">
        <label for="titre">Titre :</label><br>
        <input type="text" name="titre" id="titre" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="resume">Résumé :</label><br>
        <textarea name="resume" id="resume" rows="4" required style="width: 100%;"></textarea>
    </div>

    <div style="margin-bottom: 10px;">
        <label for="organisme">Organisme :</label><br>
        <input type="text" name="organisme" id="organisme" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="etudiant_id">ID Étudiant :</label><br>
        <input type="number" name="etudiant_id" id="etudiant_id" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="encadrant_ex">Encadrant externe :</label><br>
        <input type="text" name="encadrant_ex" id="encadrant_ex" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="email_ex">Email encadrant externe :</label><br>
        <input type="email" name="email_ex" id="email_ex" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="encadrant_in_id">ID Encadrant interne :</label><br>
        <input type="number" name="encadrant_in_id" id="encadrant_in_id" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="rapport">Rapport (chemin ou nom du fichier PDF) :</label><br>
        <input type="text" name="rapport" id="rapport" style="width: 100%;">
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <button type="submit">Ajouter</button>
        <a href="admin_pfes.php?action=read"><button type="button">Retour</button></a>
    </div>
</form>


