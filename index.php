
<?php
    session_start();
    require "_includes/database.php";
    require "_includes/function/cleanstring.php";
    require "_partials/errors.php";
    

    if(isset($_GET['deconnect'])){
        session_destroy();
        header('Location: index.php');
        exit();
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
) {
    if(!empty($_SESSION['auth'])) {
        $componentName = !empty($_GET['component'])
            ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
            : 'users';

        $action = !empty($_GET['action'])
            ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8')
            : null;

        if (file_exists("controller/$componentName.php")) {
            require "controller/$componentName.php";
        } else {
            throw new Exception("Component '$componentName' does not exist");
        }
        
    } else if (empty($_SESSION['auth']) && !empty($_GET['component']) && $_GET['component'] == 'register') {
        require "controller/register.php";
    } else {
        require "controller/login.php";
    }
    exit();
}



?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
        <title>Parking</title>
    </head>
            <?php
                if(!empty($_SESSION['auth'])) {
                    require "_partials/navbar.php";
                    $componentName = !empty($_GET['component'])? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8'): 'home';

                    if (file_exists("controller/$componentName.php")) {
                        require "controller/$componentName.php";
                    } else {
                        throw new Exception("jajajaja le composant '$componentName' n'existe pas nulard");
                    }

                } else if ( empty($_SESSION['auth']) && !empty($_GET['component']) && $_GET['component'] == 'register') {
                    require "controller/register.php";

                } else {
                    require "controller/login.php";
                }
            ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
