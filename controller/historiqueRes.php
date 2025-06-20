<?php

    require "model/historiqueRes.php";

    $reservations = getAllReservations($pdo, $_SESSION['id']);
    

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

            if($_GET['action'] == 'notation'){
                $parkingId = cleanString($_POST['parkingId']);
                $userId = cleanString($_POST['userId']);
                $note = cleanString($_POST['noteValue']);

                if(haveReview($pdo, $userId, $parkingId) == true){
                    updateReview($pdo, $userId, $parkingId, $note);
                    echo json_encode(['success' => "Note mise à jour avec succès"]);
                    updateNote($pdo, $parkingId);
                    exit();
                } else {
                    if(addReview($pdo, $userId, $parkingId, $note)){
                        echo json_encode(['success' => "Note ajoutée avec succès"]);
                        updateNote($pdo, $parkingId);
                        exit();
                    } else {
                        echo json_encode(['error' => "Erreur lors de l'ajout de la note"]);
                        exit();
                    }
                }
            }

    }


    require "view/historiqueRes.php";

?>