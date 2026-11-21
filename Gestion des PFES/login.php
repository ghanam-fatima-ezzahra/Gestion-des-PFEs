<html lang="fr">
<head> <title>Gestion des PFE</title> </head>
<body>
<?php
require("includes/header.php");
?>
<main>
    <div>
        <form action="login_verif.php" method="post">
            <fieldset>
                <legend><h2>Authentification</h2></legend>

                <label>Email :</label><br>
                <input type="text" name="username"><br><br>

                <label>Mot de passe :</label><br>
                <input type="password" name="password"><br><br>

                <button type="submit">Envoyer</button>
                <!-- Lien "Mot de passe oublié" -->
                <p><a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></p>
            </fieldset>

            <?php
            if (isset($_GET["msg"])) echo "<h3>", $_GET['msg'], "</h3>";
            ?>
        </form>
    </div>

</main>

<?php
require("includes/footer.html");
?>