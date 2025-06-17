<?php
    require "model/home.php";

    $car = getCar($pdo, $_SESSION['id']);
    $reservation = getReservation($pdo, $_SESSION['id']);
    var_dump($reservation);
    

    require "view/home.php";
?>