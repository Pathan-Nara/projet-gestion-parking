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
        $query = "SELECT * FROM reservations WHERE user_id = :id";
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

?>