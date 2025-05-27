<?php 

    if ($_SESSION['is_admin'] != 1){
        header("Location: index.php");
        exit();
    }
    require "model/menuAdmin.php";



    require "view/menuAdmin.php";
?>