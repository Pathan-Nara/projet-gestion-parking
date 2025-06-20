<?php

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

    function getReservation($pdo, $id){
        $query = "SELECT * FROM reservations JOIN place ON reservations.place_id = place.id JOIN parkingtable ON place.parking_id = parkingtable.id WHERE reservations.user_id = :id AND reservations.archived = 0";
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

    function cancelReservation($pdo, $reservationId, $placeId) {
        $query = "UPDATE reservations SET status = 'annulée' WHERE reservation_id = :reservationId";
        $query2 = "UPDATE place SET reserved = 0 WHERE id = :placeId";
        $prep = $pdo->prepare($query);
        $prep2 = $pdo->prepare($query2);
        $prep->bindValue(':reservationId', $reservationId, PDO::PARAM_INT);
        $prep2->bindValue(':placeId', $placeId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep2->execute();
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
        $prep->closeCursor();
        $prep2->closeCursor();
        return true;
    }

    function archiveReservation($pdo, $reservationId) {
        $query = "UPDATE reservations SET archived = 1 WHERE reservation_id = :reservationId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':reservationId', $reservationId, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
        $prep->closeCursor();
        return true;
    }

    function getReservationById($pdo, $reservationId) {
        $query = "SELECT * FROM reservations WHERE reservation_id = :reservationId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':reservationId', $reservationId, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
        $response = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $response;
    }

    function updateReservationAsPaid($pdo, $reservationId, $userId) {
        $query = "UPDATE reservations SET is_paid = 1 WHERE reservation_id = :reservationId AND user_id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':reservationId', $reservationId, PDO::PARAM_INT);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
        $prep->closeCursor();
        return true;
    }

?>