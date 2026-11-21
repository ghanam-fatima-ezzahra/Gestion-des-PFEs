<?php
// Vérifie si le fichier a été téléchargé sans erreur.
if (isset($_FILES["rapport"]) && $_FILES["rapport"]["error"] == 0) {
    $nom = $_FILES["rapport"]["name"];
    // Vérifie l'extension du fichier.
    $extension = pathinfo($nom, PATHINFO_EXTENSION);
    if ($extension != "pdf")
    {die("Erreur : Veuillez sélectionner un format PDF de fichier.");}
    // Copier le fichier  dans le dossier rapports
    move_uploaded_file($_FILES["rapport"]["tmp_name"], "rapports/" . $nom);
    echo "Fichier enregistré", $nom;
}
else
{ echo "Erreur : " . $_FILES["rapport"]["error"]; }
?>
<br><br>
<a href="index.php" >Retour</a>

