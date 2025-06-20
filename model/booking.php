<?php

    function getParking($pdo) {
        $query = "SELECT * FROM parkingtable INNER JOIN tarifs ON parkingtable.id = tarifs.parking_id";
        $prep = $pdo->prepare($query);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            $response = "Erreur de connexion : " . $e->getMessage();
            return $response;
        }
        $response = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $response;
    }

        function getCar($pdo, $id){
        $query = "SELECT * FROM voiture WHERE user_id = :id";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);
        try{
            $prep->execute();
        } catch (PDOException $e) {
            $response = "Erreur de connexion : " . $e->getMessage();
            return $response;
        }
        $response = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $response;
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
        $prep->closeCursor();
        return $result;
    }


    function addReservation($pdo, $placeId, $vehiculeId, $userId, $debut, $fin, $prix, $is_paid = 0) {

        $query = "INSERT INTO reservations (place_id, user_id, voiture_id, arrive, depart, status, prix, archived, is_paid) VALUES (:placeId, :userId, :vehiculeId, :debut, :fin, 'en cours', :prix, 0, :is_paid)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':placeId', $placeId, PDO::PARAM_INT);
        $prep->bindValue(':vehiculeId', $vehiculeId, PDO::PARAM_INT);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prep->bindValue(':debut', $debut, PDO::PARAM_STR);
        $prep->bindValue(':fin', $fin, PDO::PARAM_STR);
        $prep->bindValue(':prix', $prix, PDO::PARAM_STR);
        $prep->bindValue(':is_paid', $is_paid, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $prep->closeCursor();
        $query2 = "UPDATE place SET reserved = 1 WHERE id = :placeId";
        $prep2 = $pdo->prepare($query2);
        $prep2->bindValue(':placeId', $placeId, PDO::PARAM_INT);
        try {
            $prep2->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $prep2->closeCursor();
        return true;

    }

    function getPriceByHour($tarif, $heureDebut, $heureFin) {
        $heureDebut = strtotime($heureDebut);
        $heureFin = strtotime($heureFin);
        
        return (ceil(($heureFin - $heureDebut) / 3600))* $tarif;
    }

    function getPricePerDay($tarif, $dateDebut, $dateFin) {
        $dateDebut = strtotime($dateDebut);
        $dateFin = strtotime($dateFin);

        return (($dateFin - $dateDebut) / 86400) * $tarif;
        
    }

    function getTypeByVehicleId($pdo, $vehicleId) {
        $query = "SELECT type FROM voiture WHERE id = :vehicleId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':vehicleId', $vehicleId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return null;
        }
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $result;
    }

    function getPlacesByParkingIdAndType($pdo, $parkingId, $type) {
        $query = "SELECT * FROM place WHERE parking_id = :parkingId AND type_place = :type AND reserved = 0";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep->bindValue(':type', $type, PDO::PARAM_STR);
        
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return null;
        }
        $response = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $response;
    }

    function getReservation($pdo, $parkingId, $type = null){

        if($type == null){
            $query = "SELECT count(*) as total FROM place WHERE parking_id = :parkingId AND reserved = 1";
            $prep = $pdo->prepare($query);
            $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
            try {
                $prep->execute();
            } catch (PDOException $e) {
                return null;
            }
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $result['total'];
            
        } else {
            $query = "SELECT count(*) as total FROM place WHERE parking_id = :parkingId AND type_place = :type AND reserved = 1";
            $prep = $pdo->prepare($query);
            $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
            $prep->bindValue(':type', $type, PDO::PARAM_STR);
            try {
                $prep->execute();
            } catch (PDOException $e) {
                return null;
            }
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $result['total'];
        }
        
    }

?>