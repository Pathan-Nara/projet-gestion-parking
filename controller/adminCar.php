<?php
    require "model/adminCar.php";

    $cars = getCar($pdo);
    

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

    }

    require "view/adminCar.php";
?>