<?php

    require "model/adminReservation.php";

    $reservations = getAllReservations($pdo);

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
       $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        $error = [];

        if ($_GET['action'] == 'delete') {
            $reservationId = cleanString($_POST['reservationId']);
            if (deleteReservation($pdo, $reservationId) != true) {
                $error[] = "Erreur lors de la suppression de la réservation";
                echo json_encode(['error' => $error]);
                exit();
            } else {
                echo json_encode(['success' => "Réservation supprimée avec succès"]);
                exit();
            }
        }
    }


    require "view/adminReservation.php";

?>