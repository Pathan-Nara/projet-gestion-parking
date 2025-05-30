<?php
    function getCar(PDO $pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

?>