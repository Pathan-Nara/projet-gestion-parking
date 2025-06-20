<?php

    if ($_SESSION['is_admin'] != 1){
        header("Location: index.php");
        exit();
    }
    require "model/addParking.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){

        $name = getParkingName($pdo);

        $nom = cleanString($_POST['nom']);
        $tabName = array_column($name, 'nom');
        
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
        $parkingId = addParking($pdo, $nom, $adresse, $description, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion, $horaires) ;
        

        if(empty($parkingId)){
            $error[] = "Erreur lors de l'ajout du parking";
            echo json_encode(['error' => $error]);
            exit();
        }
        
        if(addPlaces($pdo, $parkingId, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion) != true){
            $error[] = "Erreur lors de l'ajout des places";
            echo json_encode(['error' => $error]);
            exit();
        }

        if(addTarif($pdo, $parkingId, $tarifperhour, $tarifperday) != true){
            $error[] = "Erreur lors de l'ajout du tarif";
            echo json_encode(['error' => $error]);
            exit();
        }

        echo json_encode(['success' => "Parking ajouté avec succès"]);
        exit();
        
    }

    require "view/addParking.php";

?>