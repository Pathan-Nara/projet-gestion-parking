<?php 

    require "model/adminCar.php";

    $users = getUsers($pdo);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        
        $model = cleanString($_POST['model']);
        $marque = cleanString($_POST['marque']);
        $type = cleanString($_POST['type']);
        $imatriculation = cleanString($_POST['imatriculation']);
        $motorisation = cleanString($_POST['motorisation']);
        $userId = cleanString($_POST['userId']);
        $error = [];
        if (addCar($pdo, $userId, $model, $marque, $type, $imatriculation, $motorisation) != true) {
            $error[] = "Erreur lors de l'ajout de la voiture";
            echo json_encode(['error' => $error]);
            exit();
        } else {
            echo json_encode(['success' => "Voiture ajoutée avec succès"]);
            exit();
        }

    }

    require "view/adminAddCar.php";

?>