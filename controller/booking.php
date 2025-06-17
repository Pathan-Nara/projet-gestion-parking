<?php

    require "model/booking.php";

    $parkings = getParking($pdo);
    $reservation = [];
    foreach ($parkings as $parking){
        $reservation[$parking['id']]['total']  = getReservation($pdo, $parking['parking_id']);
        $reservation[$parking['id']]['voiture'] = getReservation($pdo, $parking['parking_id'], 'voiture');
        $reservation[$parking['id']]['moto'] = getReservation($pdo, $parking['parking_id'], 'moto');
        $reservation[$parking['id']]['camion'] = getReservation($pdo, $parking['parking_id'], 'camion');
        $reservation[$parking['id']]['velo'] = getReservation($pdo, $parking['parking_id'], 'velo');
    }

    $voiture = getCar($pdo, $_SESSION['id']);
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        
        if ($_GET['action'] == 'getPlaces'){
            $parkingId = cleanString($_POST['parkingId']);
            $vehiculeId = cleanString($_POST['vehicule']);
            $error = [];
            $type = getTypeByVehicleId($pdo, $vehiculeId);
            if ($type == null) {
                $error[] = "Type de véhicule introuvable";
                echo json_encode(['error' => $error]);
                exit();
            }
            $places = getPlacesByParkingIdAndType($pdo, $parkingId, $type['type']);
            if ($places == null) {
                $error[] = "Aucune place disponible pour ce type de véhicule";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Places récupérées avec succès", 'places' => $places]);
                exit();
            }
        }


        if ($_GET['action'] == 'price'){
            
            $type = cleanString($_POST['type']);
            $parkingId = cleanString($_POST['parkingId']);
            $error = [];

            if($type == 'hour'){
                $heureDebut = cleanString($_POST['heureDebut']);
                $heureFin = cleanString($_POST['heureFin']);
                $tarif = getTarifByParkingId($pdo, $parkingId);
                if ($tarif == null) {
                    $error[] = "Tarif introuvable";
                    echo json_encode(['error' => $error]);
                    exit();
                } else {
                    $total = getPriceByHour($tarif['prix_par_heure'], $heureDebut, $heureFin);
                    echo json_encode(['success' => "Prix calculé avec succès", 'total' => $total]);
                    exit();
                }
            } else if ($type == 'day'){
                $dateDebut = cleanString($_POST['dateDebut']);
                $dateFin = cleanString($_POST['dateFin']);
                $tarif = getTarifByParkingId($pdo, $parkingId);
                if ($tarif == null) {
                    $error[] = "Tarif introuvable";
                    echo json_encode(['error' => $error]);
                    exit();
                } else {
                    $total = getPricePerDay($tarif['prix_par_jour'], $dateDebut, $dateFin);
                }
                echo json_encode(['success' => "Prix calculé avec succès", 'total' => $total]);
                exit();
            }
        }

        if($_GET['action'] == 'addReservation'){

            $parkingId = cleanString($_POST['parkingId']);
            $vehiculeId = cleanString($_POST['vehicule']);
            $placeId = cleanString($_POST['place']);
            $type = cleanString($_POST['type']);
            $prix = cleanString($_POST['prix']);
            $prix = (int)$prix;
            $userId = $_SESSION['id'];
            $error = [];

            if($type == 'hour'){
                $heureDebut = strtotime(cleanString($_POST['heureDebut']));
                $heureFin = strtotime(cleanString($_POST['heureFin']));
                addReservation($pdo, $placeId, $vehiculeId, $userId, $heureDebut, $heureFin, $prix);
                echo json_encode(['success' => "Réservation ajoutée avec succès"]);
                exit();
                
            }
            else if ($type == 'day'){
                $dateDebut = strtotime(cleanString($_POST['dateDebut']));
                $dateFin = strtotime(cleanString($_POST['dateFin']));
                addReservation($pdo, $placeId, $vehiculeId, $userId, $dateDebut, $dateFin, $prix);
                echo json_encode(['success' => "Réservation ajoutée avec succès"]);
                exit();
            }
        }
        
    }
    require "view/booking.php";

?>