<?php
    function getCar(PDO $pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM voiture INNER JOIN users ON voiture.user_id = users.id";
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

?>