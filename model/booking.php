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


    function getReservation($pdo, $parkingId, $type = null){
        if($type === null){
            $query = "SELECT COUNT(*) as total FROM reservations INNER JOIN place ON reservations.place_id = place.id WHERE place.parking_id = :parkingId";
            $prep = $pdo->prepare($query);
            $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        } else {
            $query = "SELECT COUNT(*) as total FROM reservations INNER JOIN place ON reservations.place_id = place.id WHERE place.parking_id = :parkingId AND place.type_place = :type";
            $prep = $pdo->prepare($query);
            $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
            $prep->bindValue(':type', $type, PDO::PARAM_STR);
        }

        try {
            $prep->execute();
        } catch (PDOException $e) {
            $response = "Erreur de connexion : " . $e->getMessage();
            return $response;
        }
        $response = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $response['total'];
    }

?>