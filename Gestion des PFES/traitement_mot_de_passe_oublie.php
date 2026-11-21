<?php
require("config_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier la connexion à la base de données
    if (!$conn) {
        die("Erreur : Connexion à la base de données échouée.");
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Vérifier si l'email existe dans la table `users`
    $req = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($req);
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Générer un nouveau mot de passe temporaire
        $nouveauMotDePasse = bin2hex(random_bytes(4)); // Exemple : "a1b2c3d4"
        $nouveauMotDePasseHash = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la table `users`
        $update = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($update);
        if (!$stmt) {
            die("Erreur de préparation de la requête de mise à jour : " . $conn->error);
        }

        $stmt->bind_param("ss", $nouveauMotDePasseHash, $email);

        if ($stmt->execute()) {
            // Envoyer le nouveau mot de passe par email
            $sujet = "Réinitialisation de votre mot de passe";
            $message = "Bonjour,\n\nVotre nouveau mot de passe est : $nouveauMotDePasse\n\nVeuillez le changer après votre connexion.";
            $headers = "From: admin@votre-site.com";

            if (mail($email, $sujet, $message, $headers)) {
                echo "Un email avec votre nouveau mot de passe a été envoyé.";
            } else {
                echo "Erreur lors de l'envoi de l'email.";
            }
        } else {
            echo "Erreur lors de la mise à jour du mot de passe.";
        }
    } else {
        echo "Aucun compte trouvé avec cet email.";
    }
}
?>
<a href="login.php"  >Retour</a>
