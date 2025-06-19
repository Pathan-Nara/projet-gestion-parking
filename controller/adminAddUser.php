<?php

    require "model/register.php";

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $firstName = cleanString($_POST['firstName']);
        $lastName = cleanString($_POST['lastName']);
        $password = cleanString($_POST['password']);
        $email = cleanString($_POST['email']);
        $is_admin = $_POST['is_admin'];
        $is_premium = $_POST['is_premium'];
        $error = [];
        if( getUserByEmail($pdo, $email) != null){
            $error[] = "Un utilisateur avec cette adresse e-mail existe déjà";
            echo json_encode(['error' => $error]);
            exit();
        }
        if(register($pdo, $email, $password, $firstName, $lastName, $is_admin, $is_premium) != true){
            $error[] = "Erreur lors de l'ajout de l'utilisateur";
            echo json_encode(['error' => $error]);
            exit();
        } else {
            echo json_encode(['success' => "Utilisateur ajouté avec succès"]);
            exit();
        }


    }

    require "view/adminAddUser.php";
?>
