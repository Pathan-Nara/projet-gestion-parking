<?php

    require "model/booking.php";

    $parkings = getParking($pdo);
    $reservation = [];
    foreach ($parkings as $parking){
        $reservation[$parking['id']]['total']  = getReservation($pdo, $parking['id']);
        $reservation[$parking['id']]['voiture'] = getReservation($pdo, $parking['id'], 'voiture');
        $reservation[$parking['id']]['moto'] = getReservation($pdo, $parking['id'], 'moto');
        $reservation[$parking['id']]['camion'] = getReservation($pdo, $parking['id'], 'camion');
        $reservation[$parking['id']]['velo'] = getReservation($pdo, $parking['id'], 'velo');
    }


    $voiture = getCar($pdo, $_SESSION['id']);
    
    var_dump($voiture[0]['model']);

    var_dump($voiture);
    
    require "view/booking.php";

?>