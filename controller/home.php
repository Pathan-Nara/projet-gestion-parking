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

            if ($_GET['action'] == 'getReservations') {
                $reservationId = cleanString($_POST['id']);
                $error = [];
                if (empty($reservationId)) {
                    $error[] = "ID de réservation manquant";
                    echo json_encode(['error' => $error]);
                    exit();
                }
                $reservationDetails = getReservationById($pdo, $reservationId);
                if ($reservationDetails === false) {
                    $error[] = "Réservation introuvable";
                    echo json_encode(['error' => $error]);
                    exit();
                } else {
                    echo json_encode(['success' => "Réservation récupérée avec succès", 'reservation' => $reservationDetails]);
                    exit();
                }
            }

            if ($_GET['action'] == 'payment') {
                $reservationId = cleanString($_POST['id']);
                $prix = cleanString($_POST['prix']);
                $error = [];
                if (empty($reservationId)) {
                    $error[] = "ID de réservation manquant";
                    echo json_encode(['error' => $error]);
                    exit();
                }
                if (empty($prix)) {
                    $error[] = "Prix manquant";
                    echo json_encode(['error' => $error]);
                    exit();
                }
                
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => ['name' => 'Réservation de place de parking'],
                            'unit_amount' => $prix * 100,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => "http://127.0.0.1/projet_fin_d'ann%C3%A9e/index.php?component=home&action=success&session_id={CHECKOUT_SESSION_ID}",
                    'cancel_url' => "http://127.0.0.1/projet_fin_d'ann%C3%A9e/index.php?component=home",
                    'metadata' => ['reservation_id' => $reservationId, 'user_id' => $_SESSION['id']]
                ]);

                echo json_encode(['id' => $session->id]);
                exit();
                
            }

        }

        if (isset($_GET['action']) && $_GET['action'] == 'success') {
            $sessionId = $_GET['session_id'];
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            $metadata = $session->metadata;
            $reservationId = $metadata->reservation_id;
            $userId = $metadata->user_id;

            updateReservationAsPaid($pdo, $reservationId, $userId);
            header("Location: index.php?component=home");
            
        }
    

    require "view/home.php";
?>