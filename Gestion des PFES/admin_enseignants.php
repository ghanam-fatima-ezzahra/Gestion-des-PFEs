<?php
require("config_db.php");
require("includes/header.php");

// Vérifier l'action demandée
$action = isset($_GET['action']) ? $_GET['action'] : 'read';

// Charger le fichier correspondant à l'action
switch ($action) {
    case 'create':
        include("create_enseignant.php");
        break;

    case 'read':
        include("read_enseignants.php");
        break;

    case 'update':
        include("update_enseignant.php");
        break;

    case 'delete':
        include("delete_enseignant.php");
        break;

    default:
        echo "<h2>Action non reconnue</h2>";
        break;
}

require("includes/footer.html");
?>

