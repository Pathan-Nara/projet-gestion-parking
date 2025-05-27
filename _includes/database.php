<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=parking",'root','');
} catch (Exception $e) {
    $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
}
?>