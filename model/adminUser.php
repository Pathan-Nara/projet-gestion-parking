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

?>