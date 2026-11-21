<?php
require("includes/header.php");
require("config_db.php");

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
?>

<main>
    <h2>Recherche de PFE</h2>

    <!-- Formulaire de recherche -->
    <form action="recherche_pfe.php" method="GET">
        <input type="text" name="query" placeholder="Entrez un mot-clé..." required>
        <button type="submit">Rechercher</button>
    </form>

    <hr>

    <?php
    // Vérifier si une recherche a été effectuée
    if (isset($_GET['query'])) {
        $query = trim($_GET['query']);

        if ($query == "") {
            echo "<p>Veuillez entrer un mot-clé valide.</p>";
        } else {
            // Sécuriser la requête SQL avec une requête préparée
            $sql = "SELECT pfes.*, enseignants.nom AS nom_encadrant, enseignants.prenom AS prenom_encadrant 
                    FROM pfes 
                    LEFT JOIN enseignants ON pfes.encadrant_in_id = enseignants.id
                    WHERE pfes.titre LIKE ? OR pfes.resume LIKE ?";
            $stmt = mysqli_prepare($conn, $sql);
            $searchQuery = "%$query%";
            mysqli_stmt_bind_param($stmt, "ss", $searchQuery, $searchQuery);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            echo "<h3>Résultats pour : '$query'</h3>";

            if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Titre</th><th>Résumé</th><th>Rapport</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['titre'] . "</td>";
        echo "<td>" . $row['resume'] . "</td>";

        if (!empty($row['rapport']) && file_exists("rapports/" . $row['rapport'])) {
            echo "<td><a href='rapports/" . $row['rapport']. "' target='_blank'>Voir le rapport</a></td>";
        } else {
            echo "<td><em>Aucun rapport disponible</em></td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}


             else {
                echo "<p>Aucun PFE trouvé.</p>";
            }
        }
    }
    ?>
</main>

<?php require("includes/footer.html"); ?>


