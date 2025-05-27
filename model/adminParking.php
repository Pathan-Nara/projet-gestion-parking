<?php

    function getParking($pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM parkingtable";

        $prep = $pdo->prepare($query);
        try{
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des parkings : " . $e->getMessage();
            return [];
        }
    }

    function deleteParking($pdo, $parkingId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM parkingtable WHERE id = :parkingId";
        $query2 = "DELETE FROM tarifs WHERE parking_id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep2 = $pdo->prepare($query2);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep2->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $prep2->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du parking : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        $prep2->closeCursor();
        return true;
    }

    function getParkingById($pdo, $parkingId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM parkingtable WHERE id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du parking : " . $e->getMessage();
            return null;
        }
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function getTarifByParkingId($pdo, $parkingId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM tarifs WHERE parking_id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du tarif : " . $e->getMessage();
            return null;
        }
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function editParking($pdo, $parkingId, $nom, $adresse, $description, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion, $horaires) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE parkingtable SET nom = :nom, adresse = :adresse, description = :description, nb_places_voiture = :nb_places_voiture, nb_places_moto = :nb_places_moto, nb_places_velo = :nb_places_velo, nb_places_camion = :nb_places_camion, horaires = :horaires WHERE id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':nom', $nom);
        $prep->bindValue(':adresse', $adresse);
        $prep->bindValue(':description', $description);
        $prep->bindValue(':nb_places_voiture', $nb_places_voiture, PDO::PARAM_INT);
        $prep->bindValue(':nb_places_moto', $nb_places_moto, PDO::PARAM_INT);
        $prep->bindValue(':nb_places_velo', $nb_places_velo, PDO::PARAM_INT);
        $prep->bindValue(':nb_places_camion', $nb_places_camion, PDO::PARAM_INT);
        $prep->bindValue(':horaires', $horaires);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            return $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la modification du parking : " . $e->getMessage();
            return false;
        }
    }

    function editTarif($pdo, $parkingId, $tarifperhour, $tarifperday) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE tarifs SET tarif_per_hour = :tarifperhour, tarif_per_day = :tarifperday WHERE parking_id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':tarifperhour', $tarifperhour, PDO::PARAM_INT);
        $prep->bindValue(':tarifperday', $tarifperday, PDO::PARAM_INT);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            return $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la modification du tarif : " . $e->getMessage();
            return false;
        }
    }

?>