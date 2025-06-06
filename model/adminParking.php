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
        $query3 = "DELETE FROM place WHERE parking_id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep2 = $pdo->prepare($query2);
        $prep3 = $pdo->prepare($query3);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep2->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep3->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $prep2->execute();
            $prep3->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du parking : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        $prep2->closeCursor();
        $prep3->closeCursor();
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
            return null;
        }
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function editParking($pdo, $parkingId, $nom, $adresse, $description, $nb_places_voiture, $nb_places_moto, $nb_places_velo, $nb_places_camion, $horaires) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE parkingtable SET nom = :nom, lieu = :adresse, description = :description, nb_places_voiture = :nb_places_voiture, nb_places_moto = :nb_places_moto, nb_places_velo = :nb_places_velo, nb_places_camion = :nb_places_camion, horaires = :horaires WHERE id = :parkingId";
        
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
    function addPlaces($pdo, $parkingId, $type, $nb_places){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO place (parking_id, type_place, reserved) VALUES (:parkingId, :type, 0)";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep->bindValue(':type', $type, PDO::PARAM_STR);
        
        try {
            for ($i = 0; $i < $nb_places; $i++) {
                $prep->execute();
            }
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout des places : " . $e->getMessage();
            return false;
        }
    }

    function removePlaces($pdo, $parkingId, $type, $nb_places){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $verif = $pdo->prepare("SELECT COUNT(*) FROM place WHERE parking_id = :parkingId AND type_place = :type AND reserved = 0");
        $verif->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $verif->bindValue(':type', $type, PDO::PARAM_STR);
        try {
            $verif->execute();
            $count = $verif->fetchColumn();
            if ($count < $nb_places) {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la vérification des places : " . $e->getMessage();
            return false;
        }
        $query = "DELETE FROM place WHERE parking_id = :parkingId AND type_place = :type AND reserved = 0 LIMIT :nb_places";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep->bindValue(':type', $type, PDO::PARAM_STR);
        $prep->bindValue(':nb_places', $nb_places, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression des places : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        return true;
    }
        

    function editTarif($pdo, $parkingId, $tarifperhour, $tarifperday) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE tarifs SET prix_par_heure = :tarifperhour, prix_par_jour = :tarifperday WHERE parking_id = :parkingId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':tarifperhour', $tarifperhour, PDO::PARAM_INT);
        $prep->bindValue(':tarifperday', $tarifperday, PDO::PARAM_INT);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la modification du tarif : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        return true;
    }

?>