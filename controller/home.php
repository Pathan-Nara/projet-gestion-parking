<?php
    require "model/home.php";

    $car = getCar($pdo, $_SESSION['id']);
    $reservation = getReservation($pdo, $_SESSION['id']);
    

    require "view/home.php";
?>