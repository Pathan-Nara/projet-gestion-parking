<?php
    require "model/profil.php";

    $vehicle = getUserCars($pdo, $_SESSION['id']);
    
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

        if($_GET['action'] == 'updateProfile') {
            $nom = cleanString($_POST['nom']);
            $prenom = cleanString($_POST['prenom']);
            $email = cleanString($_POST['email']);
            $password = cleanString($_POST['currentPassword']);
            $userId = $_SESSION['id'];

            $error = [];

            if(checkPassword($pdo, $userId, $password) != true) {
                $error[] = "Mot de passe incorrect";
                echo json_encode(['error' => $error]);
                exit();
            }

            if (updateUserProfile($pdo, $userId, $nom, $prenom, $email, $password) != true) {
                $error[] = "Erreur lors de la mise à jour du profil";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                echo json_encode(['success' => "Profil mis à jour avec succès"]);
                exit();
            }

        }
        if($_GET['action'] == 'updatePassword'){
            $currentPassword = cleanString($_POST['currentPassword']);
            $newPassword = cleanString($_POST['newPassword']);
            $userId = $_SESSION['id'];
            if(checkPassword($pdo, $userId, $currentPassword) != true) {
                $error[] = "Mot de passe incorrect";
                echo json_encode(['error' => $error]);
                exit();
            }
            else if (updatePassword($pdo, $userId, $newPassword) != true) {
                $error[] = "Erreur lors de la mise à jour du mot de passe";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Mot de passe mis à jour avec succès"]);
                exit();
            }
        }

        if($_GET['action'] == 'deleteAccount'){
            $userId = $_SESSION['id'];
            $password = cleanString($_POST['password']);
            $error = [];

            if(checkPassword($pdo, $userId, $password) != true) {
                $error[] = "Mot de passe incorrect";
                echo json_encode(['error' => $error]);
                exit();
            }

            if (deleteUser($pdo, $userId) != true) {
                $error[] = "Erreur lors de la suppression du compte";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Compte supprimé avec succès"]);
                exit();
            }
        }

        if($_GET['action'] == 'deleteCar'){
            $carId = cleanString($_POST['carId']);
            
            if (deleteCar($pdo, $carId) != true) {
                $error[] = "Erreur lors de la suppression de la voiture";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Voiture supprimée avec succès"]);
                exit();
            }
        }     
        if($_GET['action'] == 'getCar'){
            $carId = cleanString($_POST['carId']);
            $car = getCarById($pdo, $carId);
            if ($car == null) {
                $error[] = "Voiture introuvable";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Voiture récupérée avec succès", 'car' => $car]);
                exit();
            }
        }  
        if($_GET['action'] == 'updateCar'){
            $carId = cleanString($_POST['carId']);
            $marque = cleanString($_POST['marque']);
            $modele = cleanString($_POST['model']);
            $immatriculation = cleanString($_POST['immatriculation']);
            $motorisation = cleanString($_POST['motorisation']);
            $type = cleanString($_POST['type']);
            $error = [];
            if (empty($marque) || empty($modele) || empty($immatriculation) || empty($motorisation) || empty($type)) {
                $error[] = "Tous les champs sont obligatoires.";
                echo json_encode(['error' => $error]);
                exit();
            }
            if (strlen($immatriculation) != 9) {
                $error[] = "L'immatriculation doit comporter 9 caractères.";
                echo json_encode(['error' => $error]);
                exit();
            } else if ($immatriculation[2] != '-' || $immatriculation[6] != '-') {
                $error[] = "L'immatriculation doit être au format XX-XXX-XX.";
                echo json_encode(['error' => $error]);
                exit();
            }
            if (updateCar($pdo, $carId, $marque, $modele, $immatriculation, $motorisation, $type) !== true) {
                echo json_encode(['error' => "Erreur lors de la mise à jour du véhicule."]);
                exit();
            } else{
                echo json_encode(['success' => "Véhicule mis à jour avec succès"]);
                exit();
            }
        }
    }


    require "view/profil.php";
?>