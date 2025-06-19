<?php

    require "model/booking.php";
    require "model/payment.php";

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

        if ($_GET['action'] == 'payment'){

            $prix = cleanString($_POST['prix']);
            $reservationData = [
                'user_id' => $_SESSION['id'],
                'parking_id' => cleanString($_POST['parkingId']),
                'vehicule_id' => cleanString($_POST['vehicule']),
                'place_id' => cleanString($_POST['place']),
                'type' => cleanString($_POST['type']),
                'heure_debut' => cleanString($_POST['heureDebut']) ?? null,
                'heure_fin' => cleanString($_POST['heureFin']) ?? null,
                'date_debut' => cleanString($_POST['dateDebut']) ?? null,
                'date_fin' => cleanString($_POST['dateFin']) ?? null,
                'prix' => cleanString($_POST['prix'])
            ];
            
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => ['name' => 'Réservation de place de parking'],
                        'unit_amount' => $reservationData['prix'] * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => "http://127.0.0.1/projet_fin_d'ann%C3%A9e/index.php?component=booking&action=success&session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => "http://127.0.0.1/projet_fin_d'ann%C3%A9e/index.php?component=booking",
                'metadata' => $reservationData
            ]);

            echo json_encode(['id' => $session->id]);
            exit();
            
        }
        
    }
    if(isset($_GET['action'])) {
        if ($_GET['action'] == 'success') {
            $session_id = $_GET['session_id'] ?? null;
            
            if ($session_id) {
                // Récupérer la session Stripe avec toutes les infos
                $session = \Stripe\Checkout\Session::retrieve($session_id);
                
                // Vérifier que le paiement est bien validé
                if ($session->payment_status === 'paid') {
                    // Paiement validé ! Récupérer les métadonnées
                    $metadata = $session->metadata;
                    $userId = $metadata->user_id;
                    $parkingId = $metadata->parking_id;
                    $vehiculeId = $metadata->vehicule_id;
                    $placeId = $metadata->place_id;
                    $type = $metadata->type;
                    $heureDebut = $metadata->heure_debut ? strtotime($metadata->heure_debut) : null;
                    $heureFin = $metadata->heure_fin ? strtotime($metadata->heure_fin) : null;
                    $dateDebut = $metadata->date_debut ? strtotime($metadata->date_debut) : null;
                    $dateFin = $metadata->date_fin ? strtotime($metadata->date_fin) : null;
                    $prix = $metadata->prix;
                    $is_paid = 1;
                    var_dump("userId: $userId, parkingId: $parkingId, vehiculeId: $vehiculeId, placeId: $placeId, type: $type, heureDebut: $heureDebut, heureFin: $heureFin, dateDebut: $dateDebut, dateFin: $dateFin, prix: $prix");
                    if($type == 'day') {
                        var_dump(addReservation($pdo, $placeId, $vehiculeId, $userId, $dateDebut, $dateFin, $prix, $is_paid));
                        // if(addReservation($pdo, $placeId, $vehiculeId, $userId, $dateDebut, $dateFin, $prix, $is_paid) == true){
                        //     var_dump("Réservation ajoutée avec succès");
                        // }else{
                        //     var_dump("Erreur lors de l'ajout de la réservation");
                        // };
                    } else {
                        addReservation($pdo, $placeId, $vehiculeId, $userId, $heureDebut, $heureFin, $prix, $is_paid);
                    }
                }   
            }   
        }
    }

    require "view/booking.php";

?>