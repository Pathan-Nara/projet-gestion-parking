<?php

    function getAllReservations(PDO $pdo, int $userId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM reservations JOIN place ON reservations.place_id = place.id JOIN parkingtable ON place.parking_id = parkingtable.id WHERE reservations.user_id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $reservations = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $reservations;
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
    }

    function haveReview(PDO $pdo, int $userId, int $parkingId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM evaluation WHERE user_id = :userId AND parking_id = :parkingId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $review = $prep->fetch(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return !empty($review);
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
    }

    function updateReview(PDO $pdo, int $userId, int $parkingId, int $note){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE evaluation SET note = :note WHERE user_id = :userId AND parking_id = :parkingId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep->bindValue(':note', $note, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
    }

    function addReview(PDO $pdo, int $userId, int $parkingId, int $note) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO evaluation (user_id, parking_id, note) VALUES (:userId, :parkingId, :note)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        $prep->bindValue(':note', $note, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
    }

    function updateNote(PDO $pdo, int $parkingId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE parkingtable SET note = (SELECT AVG(note) FROM evaluation WHERE parking_id = :parkingId) WHERE id = :parkingId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':parkingId', $parkingId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
    }

?>