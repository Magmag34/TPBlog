<?php 
 	session_start();

    // DB Acces  TPBlog    
    require('model.php');

    $req = getBillets();


    // On teste la session à l'affichage

    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['pseudo'];
    }


// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('login', '');
setcookie('pass_hache', '');
