
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
            $parkingId = cleanString($_POST['parkingId']);
            $nom = cleanString($_POST['nom']);
            $adresse = cleanString($_POST['adresse']);
            $description = cleanString($_POST['description']);
            $nb_places_voiture = cleanString($_POST['nb_places_voiture']);
            $nb_places_moto = cleanString($_POST['nb_places_moto']);
            $nb_places_velo = cleanString($_POST['nb_places_velo']);
            $nb_places_camion = cleanString($_POST['nb_places_camion']);
            $horaires = cleanString($_POST['horaires']);
            $tarifperhour = cleanString($_POST['tarifperhour']);
            $tarifperday = cleanString($_POST['tarifperday']);
            $error = [];

            $parkingBefore = getParkingById($pdo, $parkingId);

            $newVoiture = -($parkingBefore['nb_places_voiture'] - $nb_places_voiture);
            $newMoto = -($parkingBefore['nb_places_moto'] - $nb_places_moto);
            $newVelo = -($parkingBefore['nb_places_velo'] - $nb_places_velo);
            $newCamion = -($parkingBefore['nb_places_camion'] - $nb_places_camion );

            $tab = [
                'voiture' => $newVoiture,
                'moto' => $newMoto,
                'velo' => $newVelo,
                'camion' => $newCamion
            ];

            foreach ($tab as $type => $value) {
                if ($value < 0){
                    if(removePlaces($pdo, $parkingId, $type, -$value) != true) {
                        $error[] = "Erreur lors de la suppression des places de type $type";
                        echo json_encode(['error' => $error]);
                        exit();
                    }
                } elseif($value > 0) {
                    if(addPlaces($pdo, $parkingId, $type, $value) != true) {
                        $error[] = "Erreur lors de l'ajout des places de type $type";
                        echo json_encode(['error' => $error]);
                        exit();
                    }
                }
            }

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
        echo json_encode(['error' => "Action non reconnue"]);
        exit();
        
    }
    
    require "view/adminParking.php";

?>