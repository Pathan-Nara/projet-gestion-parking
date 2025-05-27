<?php

    if ($_SESSION['is_admin'] != 1){
        header("Location: index.php");
        exit();
    }
    require "model/addParking.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
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
        
        if(addParking($pdo, $nom, $adresse, $description, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion, $horaires) != true){
            $error[] = "Erreur lors de l'ajout du parking";
            echo json_encode(['error' => $error]);
            exit();
        }
        
        $parkingId = getParkingIdByName($pdo, $nom);

        if(addTarif($pdo, $parkingId['id'], $tarifperhour, $tarifperday) != true){
            $error[] = "Erreur lors de l'ajout du tarif";
            echo json_encode(['error' => $error]);
            exit();
        }

        echo json_encode(['success' => "Parking ajouté avec succès"]);
        exit();
        
    }

    require "view/addParking.php";

?>