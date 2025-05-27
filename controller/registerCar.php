<?php

    require "model/registerCar.php";

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $marque = cleanString($_POST['marque']);
        $modele = cleanString($_POST['modele']);
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
        if (registerCar($pdo, $marque, $modele, $immatriculation, $motorisation, $type, $_SESSION['id']) !== true) {
            echo json_encode(['error' => "Erreur lors de l'enregistrement du véhicule."]);
            exit();
        }

        echo json_encode(['success' => "Véhicule enregistré avec succès."]);
        exit();
        

    }

    require "view/registerCar.php";

?>