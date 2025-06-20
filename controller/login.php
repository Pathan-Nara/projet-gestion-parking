<?php
/**
 * @var PDO $pdo
 */
    

    require "model/login.php";

    if (isset($_SESSION['auth']) && $_SESSION['auth'] == true){
        header("Location: index.php");
        exit();
    }
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $username = cleanString($_POST['username']);
        $password = cleanString($_POST['password']);
        $error = [];
        if (empty($username) || empty($password)){
            $error[] = "Veuillez remplir tous les champs";

        } else {
            $user = connetion($pdo, $username);
            if (empty($user)){
                $error[] = "Utilisateur introuvable";
            }

            else if ($user['email'] != $username){
                $error[] = "Nom d'utilisateur incorrect";

            } else if (password_verify($password, $user['password']) == false){
                $error[] = "Mot de passe incorrect";;
            } else if(empty($error)) {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['is_premium'] = $user['is_premium'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['nom'] = $user['nom'];
                header("Content-Type: application/json");
                echo json_encode(['authentication' => true]);
                exit();
            }
            
        }

        header("Content-Type: application/json");
        echo json_encode(['errors' => $error]);
        exit();
    }


    require "view/login.php";
?>