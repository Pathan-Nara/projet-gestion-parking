<?php
    function getAllReservations(PDO $pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM reservations 
                  JOIN users ON reservations.user_id = users.id 
                  JOIN place ON reservations.place_id = place.id 
                  JOIN parkingtable ON place.parking_id = parkingtable.id";
        $prep = $pdo->prepare($query);
        try {
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des réservations : " . $e->getMessage();
            return [];
        }
        
    }

    function deleteReservation(PDO $pdo, $reservationId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM reservations WHERE reservation_id = :reservationId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':reservationId', $reservationId, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la réservation : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        return true;
    }
?>