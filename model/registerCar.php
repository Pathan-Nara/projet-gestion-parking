<?php

    function registerCar(PDO $pdo, string $marque, string $modele, string $immatriculation, string $motorisation, string $type, int $userId){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO voiture (marque, model, imatriculation, type, motorisation, user_id) VALUES (:marque, :modele, :immatriculation,:type, :motorisation, :userId)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':marque', $marque, PDO::PARAM_STR);
        $prep->bindValue(':modele', $modele, PDO::PARAM_STR);
        $prep->bindValue(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $prep->bindValue(':motorisation', $motorisation, PDO::PARAM_STR);
        $prep->bindValue(':type', $type, PDO::PARAM_STR);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur de connection : " . $e->getMessage();
        }
    }

?>