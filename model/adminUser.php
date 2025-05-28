<?php 

    function getAllUser(PDO $pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM users";
        
        $prep = $pdo->prepare($query);
        try {
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
            return [];
        }
    }

    function deleteUser(PDO $pdo, $userId){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM users WHERE id = :userId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        return true;
    }

    function getUserById(PDO $pdo, $userId){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM users WHERE id = :userId";
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return null;
        }
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $result;
    }

    function editUser(PDO $pdo, $userId, $prenom, $nom, $email, $is_admin, $is_premium, $password){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($password != null){
            $query = "UPDATE users SET prenom = :prenom, nom = :nom, email = :email, is_admin = :is_admin, is_premium = :is_premium password = :password WHERE id = :userId";
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $query = "UPDATE users SET prenom = :prenom, nom = :nom, email = :email, is_admin = :is_admin, is_premium = :is_premium WHERE id = :userId";
        }
        
        $prep = $pdo->prepare($query);
        $prep->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $prep->bindValue(':nom', $nom, PDO::PARAM_STR);
        $prep->bindValue(':email', $email, PDO::PARAM_STR);
        $prep->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
        $prep->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prep->bindValue(':is_premium', $is_premium, PDO::PARAM_INT);
        if ($password != null) {
            $prep->bindValue(':password', $passwordHash, PDO::PARAM_STR);
        }
        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la modification de l'utilisateur : " . $e->getMessage();
            return false;
        }
        $prep->closeCursor();
        return true;
    }

?>