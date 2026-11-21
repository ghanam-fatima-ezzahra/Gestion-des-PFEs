<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Réinitialiser le mot de passe</h1>
<form action="traitement_mot_de_passe_oublie.php" method="POST">
    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" placeholder="Entrez votre email" required>
    <button type="submit">Envoyer</button>
</form>
</body>
</html>
