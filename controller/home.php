<?php
    require "model/home.php";

    $car = getCar($pdo, $_SESSION['id']);
    $reservation = getReservation($pdo, $_SESSION['id']);
    // var_dump($reservation);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        
            if ($_GET['action'] == 'cancel'){
                // var_dump($_POST);
                $reservationId = cleanString($_POST['id']);
                $placeId = cleanString($_POST['placeId']);
                
                $error = [];
                if (empty($reservationId)) {
                    $error[] = "ID de réservation manquant";
                    echo json_encode(['error' => $error]);
                    exit();
                }
                $result = cancelReservation($pdo, $reservationId, $placeId);
                if ($result === true) {
                    echo json_encode(['success' => "Réservation annulée avec succès"]);
                    exit();
                } else {
                    $error[] = $result;
                    echo json_encode(['error' => $error]);
                    exit();
                }
            }

            if($_GET['action'] == 'archive'){
                $reservationId = cleanString($_POST['id']);
                $error = [];
                if (empty($reservationId)) {
                    $error[] = "ID de réservation manquant";
                    echo json_encode(['error' => $error]);
                    exit();
                }
                $result = archiveReservation($pdo, $reservationId);
                if ($result === true) {
                    echo json_encode(['success' => "Réservation archivée avec succès"]);
                    exit();
                } else {
                    $error[] = $result;
                    echo json_encode(['error' => $error]);
                    exit();
                }
            }

        }
    

    require "view/home.php";
?>