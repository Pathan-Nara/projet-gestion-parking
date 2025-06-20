<?php
    require "model/adminCar.php";

    $cars = getCar($pdo);
    $users = getUsers($pdo);
    

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){

        if($_GET['action'] == 'delete'){
            $carId = cleanString($_POST['carId']);
            $error = [];

            if (deleteCar($pdo, $carId) != true) {
                $error[] = "Erreur lors de la suppression de la voiture";
                echo json_encode(['error' => $error]);
                exit();
            }

            echo json_encode(['success' => "Voiture supprimée avec succès"]);
            exit();
        }

        if($_GET['action'] == 'getCar'){
            $carId = cleanString($_POST['carId']);
            $error = [];
            $car = getCar($pdo, $carId);
            if ($car == null) {
                $error[] = "Voiture introuvable";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['car' => $car]);
                exit();
            }
        }
        if($_GET['action'] == 'edit'){
            $carId = cleanString($_POST['carId']);
            $userId = cleanString($_POST['user_id']);
            $model = cleanString($_POST['model']);
            $marque = cleanString($_POST['marque']);
            $type = cleanString($_POST['type']);
            $imatriculation = cleanString($_POST['imatriculation']);
            $motorisation = cleanString($_POST['motorisation']);
            $error = [];
            if (editCar($pdo, $carId, $userId, $model, $marque, $type, $imatriculation, $motorisation) != true) {
                $error[] = "Erreur lors de la modification de la voiture";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Voiture modifiée avec succès"]);
                exit();
            }

        }
    }

    require "view/adminCar.php";
?>