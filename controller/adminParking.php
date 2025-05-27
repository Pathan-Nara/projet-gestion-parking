
<?php

    if ($_SESSION['is_admin'] != 1){
        header("Location: index.php");
        exit();
    }

    require "model/adminParking.php";

    $parkings = getParking($pdo);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        if($_GET['action'] == 'delete') {
            $parkingId = cleanString($_POST['parkingId']);
            $error = [];

            

            if (deleteParking($pdo, $parkingId) != true) {
                $error[] = "Erreur lors de la suppression du parking";
                echo json_encode(['error' => $error]);
                exit();
            }

            echo json_encode(['success' => "Parking supprimé avec succès"]);
            exit();
        } 
        if($_GET['action'] == 'getParking'){
            $parkingId = cleanString($_POST['parkingId']);
            $error = [];
            $parking = getParkingById($pdo, $parkingId);
            $tarif = getTarifByParkingId($pdo, $parkingId);
            if ($parking == null || $tarif == null) {
                $error[] = "Parking ou tarif introuvable";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Parking récupéré avec succès", 'parking' => $parking, 'tarif' => $tarif]);
                exit();
            }
        }
        if($_GET['action'] == 'edit'){
            $parkingId = cleanString($_POST['id']);
            $nom = cleanString($_POST['nom']);
            $adresse = cleanString($_POST['lieu']);
            $description = cleanString($_POST['editDescription']);
            $nb_places_voiture = cleanString($_POST['nb_places_voiture']);
            $nb_places_moto = cleanString($_POST['nb_places_moto']);
            $nb_places_velo = cleanString($_POST['nb_places_velo']);
            $nb_places_camion = cleanString($_POST['nb_places_camion']);
            $horaires = cleanString($_POST['horaires']);
            $tarifperhour = cleanString($_POST['tarifperhour']);
            $tarifperday = cleanString($_POST['tarifperday']);
            $error = [];

            if (editParking($pdo, $parkingId, $nom, $adresse, $description, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion, $horaires) != true) {
                $error[] = "Erreur lors de la modification du parking";
                echo json_encode(['error' => $error]);
                exit();
            }

            if (editTarif($pdo, $parkingId, $tarifperhour, $tarifperday) != true) {
                $error[] = "Erreur lors de la modification du tarif";
                echo json_encode(['error' => $error]);
                exit();
            }

            echo json_encode(['success' => "Parking modifié avec succès"]);
            exit();
        }
        
    }
    

    require "view/adminParking.php";

?>