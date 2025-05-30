<?php
    require "model/adminCar.php";

    $cars = getCar($pdo);
    require "view/adminCar.php";
?>