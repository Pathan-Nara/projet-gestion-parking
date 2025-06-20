<?php

    function connetion(PDO $pdo, string $email){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT *  FROM users WHERE (email = :email)";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':email', $email, PDO::PARAM_STR);
        try{
            $prep->execute();
        } catch (PDOException $e) {
            $response = "Erreur de connexion : " . $e->getMessage();
        }

        $response = $prep->fetch();
        $prep->closeCursor();
        return $response;
    }

?>