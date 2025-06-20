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

        if ($_GET['action'] == 'getUser'){
            $userId = cleanString($_POST['userId']);
            $user = getUserById($pdo, $userId);
            if ($user == null) {
                $error[] = "Utilisateur introuvable";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Utilisateur récupéré avec succès", 'user' => $user]);
                exit();
            }
        }

        if($_GET['action'] == 'update'){
            $userId = cleanString($_POST['userId']);
            $nom = cleanString($_POST['nom']);
            $prenom = cleanString($_POST['prenom']);
            $email = cleanString($_POST['email']);
            $is_admin = cleanString($_POST['isAdmin']);
            $is_premium = cleanString($_POST['isPremium']);
            $password = cleanString($_POST['password']);
            if (empty($password)) {
                $password = null;
            } 
            $error = [];

            if (editUser($pdo, $userId, $prenom, $nom, $email, $is_admin, $is_premium, $password) != true) {
                $error[] = "Erreur lors de la modification de l'utilisateur";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Utilisateur modifié avec succès"]);
                exit();
            }
        }
        
    }

    require "view/adminUser.php";
?>