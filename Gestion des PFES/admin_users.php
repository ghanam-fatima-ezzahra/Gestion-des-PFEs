<?php
require("config_db.php");
require("includes/header.php");

// Vérifier l'action demandée
$action = isset($_GET['action']) ? $_GET['action'] : 'read';

// Charger le fichier correspondant à l'action
switch ($action) {
    case 'create':
        include("create_user.php");
        break;

    case 'read':
        include("read_users.php");
        break;

    case 'update':
        include("update_user.php");
        break;

    case 'delete':
        include("delete_user.php");
        break;

    default:
        echo "<h2>Action non reconnue</h2>";
        break;
}

require("includes/footer.html");
?>
