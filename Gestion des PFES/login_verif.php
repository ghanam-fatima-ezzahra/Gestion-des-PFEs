
<?php
require("config_db.php");
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    header("location:login.php?msg=Veuillez entrer un email et un mot de passe.");
    exit();
}

$a = $_POST["username"];
$b = $_POST["password"];

// Échapper les entrées utilisateur pour éviter les injections SQL
$a = mysqli_real_escape_string($conn, $a);
$b = mysqli_real_escape_string($conn, $b);

// Vérifier si l'utilisateur existe et récupérer son rôle
$req1 = "SELECT * FROM users WHERE email='$a' AND password='$b'";
$res1 = mysqli_query($conn, $req1);

if (!$res1 || mysqli_num_rows($res1) == 0) {
    header("location:login.php?msg=Login ou mot de passe incorrect");
    exit();
}

// Récupération des données utilisateur
$row1 = mysqli_fetch_assoc($res1);
$identifiant = $row1["user_id"];
$role = $row1["role"];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['username'] = $a;
$_SESSION['profil'] = $role;

// Gestion des rôles

if ($role == "Administrateur") {  // CORRECTION ICI
    $_SESSION['id'] = null;
    $_SESSION['nom'] = "Administrateur";
    $_SESSION['prenom'] = "";
    header("location:index.php");
    exit();
} elseif ($role == "Etudiant") {
    $req2 = "SELECT * FROM etudiants WHERE id=$identifiant";
} elseif ($role == "Enseignant") {
    $req2 = "SELECT * FROM enseignants WHERE id=$identifiant";
} elseif ($role == "Visiteur") {
    $_SESSION['id'] = $identifiant;
    $_SESSION['nom'] = $row1["nom"];
    $_SESSION['prenom'] = $row1["prenom"];
    header("location:index.php");
    exit();
} else {
    header("location:login.php?msg=Rôle inconnu");
    exit();
}

// Exécution de la requête pour les étudiants et enseignants
$res2 = mysqli_query($conn, $req2);
if (!$res2 || mysqli_num_rows($res2) == 0) {
    header("location:login.php?msg=Contacter votre administrateur");
    exit();
}

// Récupération des infos supplémentaires
$row2 = mysqli_fetch_assoc($res2);
$_SESSION['id'] = $row2["id"];
$_SESSION['nom'] = $row2["nom"];
$_SESSION['prenom'] = $row2["prenom"];

// Redirection vers la page d'accueil
header("location:index.php");
exit();
?>




