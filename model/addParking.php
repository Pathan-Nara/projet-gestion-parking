<?php

    function addParking($pdo, $nom, $adresse, $description, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion, $horaires) {
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO parkingtable (nom, lieu, description, nb_places_voiture, nb_places_moto, nb_places_velo, nb_places_camion, horaires) 
                  VALUES (:nom, :adresse, :description, :nb_places_voiture, :nb_places_moto, :nb_places_velo, :nb_places_camion, :horaires)";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':nom', $nom, PDO::PARAM_STR);
        $prep->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $prep->bindValue(':description', $description, PDO::PARAM_STR);
        $prep->bindValue(':nb_places_voiture', $nb_places_voiture, PDO::PARAM_INT);
        $prep->bindValue(':nb_places_moto', $nb_places_moto, PDO::PARAM_INT);
        $prep->bindValue(':nb_places_velo', $nb_places_velo, PDO::PARAM_INT);
        $prep->bindValue(':nb_places_camion', $nb_places_camion, PDO::PARAM_INT);
        $prep->bindValue(':horaires', $horaires, PDO::PARAM_STR);

        try{
            $prep->execute();
        } catch(PDOException $e) {
            return "Erreur lors de l'ajout du parking : " . $e->getMessage();
        }
        $prep->closeCursor();
        return true;
    }

    function addPlaces($pdo, $parkingId, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = "INSERT INTO place (parking_id, type_place) VALUES (:parkingId, :type)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $types = ['voiture', 'moto', 'velo', 'camion'];
        $nb_places = [$nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion];
        try {
            foreach($types as $i => $type){
                for($j = 0; $j < $nb_places[$i]; $j++) {
                    $prep->bindValue(':type', $type, PDO::PARAM_STR);
                    $prep->execute();
                }
            }
        } catch (PDOException $e) {
            return "Erreur lors de l'ajout des places : " . $e->getMessage();
        }
        $prep->closeCursor();
        return true;
    }

    function getParkingIdByName($pdo, $name){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT id FROM parkingtable WHERE nom = :name";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':name', $name, PDO::PARAM_STR);
        try{
            $prep->execute();
        } catch (PDOException $e) {
            return "Erreur lors de la récupération de l'ID du parking : " . $e->getMessage();
        }
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $result;
    }

    function addTarif($pdo, $parkingId, $tarifperhour, $tarifperday) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = "INSERT INTO tarifs (parking_id, prix_par_heure, prix_par_jour) VALUES (:parkingId, :tarifperhour, :tarifperday)";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep->bindValue(':tarifperhour', $tarifperhour, PDO::PARAM_STR);
        $prep->bindValue(':tarifperday', $tarifperday, PDO::PARAM_STR);

        try{
            $prep->execute();
            return true;
        } catch(PDOException $e) {
            return "Erreur lors de l'ajout du tarif : " . $e->getMessage();
        }
    }
?>