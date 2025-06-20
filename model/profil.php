<?php

    function checkPassword($pdo, $userId, $password) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT password FROM users WHERE id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            if ($result && password_verify($password, $result['password'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la vérification du mot de passe : " . $e->getMessage();
            return false;
        }
    }

    function updatePassword($pdo, $userId, $newPassword) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE users SET password = :password WHERE id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':password', password_hash($newPassword, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
            return false;
        }
    }
    function getUserCars($pdo, $userId){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM voiture WHERE user_id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des voitures de l'utilisateur : " . $e->getMessage();
            return [];
        }
    }

    function updateUserProfile($pdo, $userId, $nom, $prenom, $email, $password) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE users SET nom = :nom, prenom = :prenom,  email = :email, password = :password WHERE id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':nom', $nom, PDO::PARAM_STR);
        $prep->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $prep->bindValue(':email', $email, PDO::PARAM_STR);
        $prep->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du profil utilisateur : " . $e->getMessage();
            return false;
        }
    }

    function deleteUser($pdo, $userId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM users WHERE id = :userId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du compte utilisateur : " . $e->getMessage();
            return false;
        }
    }

    function deleteCar($pdo, $carId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM voiture WHERE id = :carId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':carId', $carId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la voiture : " . $e->getMessage();
            return false;
        }
    }

    function getCarById($pdo, $carId) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM voiture WHERE id = :carId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':carId', $carId, PDO::PARAM_INT);
        try {
            $prep->execute();
            $result = $prep->fetch(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la voiture : " . $e->getMessage();
            return null;
        }
    }

    function updateCar($pdo, $carId, $marque, $modele, $immatriculation, $motorisation, $type){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE voiture SET marque = :marque, model = :modele, imatriculation = :immatriculation, motorisation = :motorisation, type = :type WHERE id = :carId";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':marque', $marque, PDO::PARAM_STR);
        $prep->bindValue(':modele', $modele, PDO::PARAM_STR);
        $prep->bindValue(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $prep->bindValue(':motorisation', $motorisation, PDO::PARAM_STR);
        $prep->bindValue(':type', $type, PDO::PARAM_STR);
        $prep->bindValue(':carId', $carId, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la voiture : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        return true;
    } 

?>