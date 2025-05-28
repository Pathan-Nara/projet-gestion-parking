<?php
    if ($_SESSION['is_admin'] != 1) {
        header("Location: index.php");
        exit();
    }

    require "model/adminUser.php";

    $users = getAllUser($pdo);

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        $error = [];

        if ($_GET['action'] == 'delete'){
            $userId = cleanString($_POST['userId']);
            if (deleteUser($pdo, $userId) != true) {
                $error[] = "Erreur lors de la suppression de l'utilisateur";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Utilisateur supprimé avec succès"]);
                exit();
            }
        }
        
    }

    require "view/adminUser.php";
?>