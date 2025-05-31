<?php
    function getCar(PDO $pdo, $carId = null){
        if ($carId) {
            $query = "SELECT 
                    voiture.id AS car_id,
                    voiture.marque,
                    voiture.model,
                    voiture.imatriculation,
                    voiture.type,
                    voiture.motorisation,
                    users.id AS user_id,
                    users.nom,
                    users.prenom,
                    users.email 
                    FROM voiture 
                    INNER JOIN users ON voiture.user_id = users.id 
                    WHERE voiture.id = :carId";
            $prep = $pdo->prepare($query);
            $prep->bindValue(':carId', $carId, PDO::PARAM_INT);
        } else {
            $query = "SELECT 
                    voiture.id AS car_id,
                    voiture.marque,
                    voiture.model,
                    voiture.imatriculation,
                    voiture.type,
                    voiture.motorisation,
                    users.id AS user_id,
                    users.nom,
                    users.prenom,
                    users.email 
                    FROM voiture 
                    INNER JOIN users ON voiture.user_id = users.id";
            $prep = $pdo->prepare($query);
        }       
        try {
            $prep->execute();
            $response = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $response;
        } catch (PDOException $e) {
            return "Erreur de connection : " . $e->getMessage();
        }
    }

    function deleteCar(PDO $pdo, $carId){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM voiture WHERE id = :carId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':carId', $carId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur lors de la suppression de la voiture : " . $e->getMessage();
        }
    }

    function getUsers(PDO $pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM users";
        
        $prep = $pdo->prepare($query);
        try {
            $prep->execute();
            $response = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $response;
        } catch (PDOException $e) {
            return "Erreur de connection : " . $e->getMessage();
        }
    }

    function editCar($pdo, $carId, $userId, $model, $marque, $type, $imatriculation, $motorisation){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE voiture SET user_id = :userId, model = :model, marque = :marque, type = :type, imatriculation = :imatriculation, motorisation = :motorisation WHERE id = :carId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prep->bindValue(':model', $model, PDO::PARAM_STR);
        $prep->bindValue(':marque', $marque, PDO::PARAM_STR);
        $prep->bindValue(':type', $type, PDO::PARAM_STR);
        $prep->bindValue(':imatriculation', $imatriculation, PDO::PARAM_STR);
        $prep->bindValue(':motorisation', $motorisation, PDO::PARAM_STR);
        $prep->bindValue(':carId', $carId, PDO::PARAM_INT);
        try{
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur lors de la modification de la voiture : " . $e->getMessage();
        }
    }

?>