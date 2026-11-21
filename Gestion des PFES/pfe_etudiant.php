<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des PFE</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
<?php
session_start(); // Démarrer la session
require("includes/header.php");
require("config_db.php");

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
?>
<main class="pfe-main">

    <div class="pfe-container">
        <?php
        // pas de connexion ou l'utilisateur connecté n'est pas un étudiant
        if(!isset($_SESSION["profil"]) or $_SESSION["profil"]!="Etudiant") header("location:index.php");
        //Table pfes (id, etudiant_id, titre, resume, organisme, encadrant_ex, email_ex, encadrant_in_id, rapport)
        $etudiant_id=$_SESSION['id']; // l'id de l'étudiant connecté
        $req="SELECT * FROM pfes WHERE etudiant_id=$etudiant_id"; //pour avoir le pfe de l'étudiant connecté
        $res = mysqli_query($conn,$req);
        $n = mysqli_num_rows($res); // nombre de lignes retournées.
        $a=0; $b= $etudiant_id; $c="";$d="";$e="";$f="";$g="";$h="";$i=""; // pour stocker les attributs du PFE à ajouter ou modifier
        if ($n!=0) // le pfe est déjà ajouté
        {
            $row = mysqli_fetch_assoc($res);
            $a=$row["id"]; $b=$row["etudiant_id"]; $c=$row["titre"];$d=$row["resume"];$e=$row["organisme"];$f=$row["encadrant_ex"];
            $g=$row["email_ex"];$h=$row["encadrant_in_id"];$i=$row["rapport"];
            // on récupère l'encadrant interne de la table enseignants (id,nom,prenom,email,dept_id)
            $reqe="SELECT * FROM enseignants where id=$h";
            $rese = mysqli_query($conn,$reqe);
            $rowe = mysqli_fetch_assoc($rese);
            ?>
            <p><strong>Titre :</strong> <?php echo $c; ?></p>
            <p><strong>Résumé :</strong> <?php echo $d; ?></p>
            <p><strong>Organisme :</strong> <?php echo $e; ?></p>
            <p><strong>Encadrant externe :</strong> <?php echo $f; ?></p>
            <p><strong>Email encadrant externe :</strong> <?php echo $g; ?></p>
            <p><strong>Encadrant interne :</strong> <?php echo $rowe['nom']," ",$rowe['prenom']; ?></p>
            <p><strong>Rapport :</strong>
                <?php
                if ($i != "") {
                    echo "<a href='rapports/$i' target='_blank' class='rapport-link'>Voir le rapport</a>";
                } else {
                    echo "Aucun rapport n'est encore uploadé";
                }
                ?>
            </p>
            <a href="upload_form.php?pfe_id=<?php echo $a; ?>" class="btn btn-green">
                <?php echo ($i == "" ? "Uploader" : "Remplacer"); ?> le rapport
            </a>
            <?php
        }
        else
            echo "<h3>Veuillez ajouter votre PFE</h3>"
        ?>
        <hr>
        <a href="editer_pfe.php" class="btn btn-blue">
            <?php echo($n == 0 ? "Ajouter PFE" : "Modifier PFE"); ?>
        </a>
    </div>
</main>
<?php
require("includes/footer.html");
?>
</body>
</html>





