<?php
/**
 * @var PDO $pdo
 */

require "model/register.php";

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true){
    header("Location: index.php");
    exit();
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $email = cleanString($_POST['email']);
        $password = cleanString($_POST['password']);
        $firstName = cleanString($_POST['firstName']);
        $lastName = cleanString($_POST['lastName']);
        $error = [];

        if (!empty(getUserByEmail($pdo, $email))){
            $error[] = "Cet email existe déjà";
            echo json_encode(['error' => $error]);
            exit();
        }
        
        if (register($pdo, $email, $password, $firstName, $lastName) == false){
            echo json_encode(['error' => "Erreur lors de l'inscription"]);
            exit();
        } else {
            echo json_encode(['success' => "Inscription réussie"]);
            exit();
        }

    }
    

require "view/register.php";

?>