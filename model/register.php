<?php

    function register(PDO $pdo, string $email, string $password, string $firstName, string $lastName, int $is_admin = 0, int $is_premium = 0){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="INSERT INTO users (email, password, prenom, nom, is_admin, is_premium) VALUES (:email, :password, :firstName, :lastName, :is_admin, :is_premium)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':email', $email, PDO::PARAM_STR);
        $prep->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $prep->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $prep->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $prep->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
        $prep->bindValue(':is_premium', $is_premium, PDO::PARAM_INT);
        try{
            $prep->execute();
            $prep->closeCursor();
            return true;
        } catch (PDOException $e) {
            return "Erreur";
        }
    }

    

    function getUserByEmail(PDO $pdo, string $email){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT *  FROM users WHERE (email = :email)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':email', $email, PDO::PARAM_STR);
        try{
            $prep->execute();
        } catch (PDOException $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }

        $response = $prep->fetch();
        $prep->closeCursor();
        return $response;
    }

?>