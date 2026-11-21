<?php
require("config_db.php");

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sujet = mysqli_real_escape_string($conn, $_POST['sujet']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $req = "INSERT INTO messages_contact (nom, email, sujet, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($req);
    $stmt->bind_param("ssss", $nom, $email, $sujet, $message);

    if ($stmt->execute()) {
        header("Location: contact.php?msg=Message envoyé avec succès");
        exit();
    } else {
        echo "Erreur lors de l'envoi du message : " . $conn->error;
    }
}
?>
