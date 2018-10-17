<?php 
 	session_start();

    // DB Acces  TPBlog    
    require('../model/frontend.php');

    //$req = getArticle();
    //$bdd = getConnexionBDD();

    // On teste la session à l'affichage

    if (isset($_SESSION['id']) AND isset($_SESSION['email']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['email'];
    }


// Suppression des variables de session et de la session
$_SESSION = [];
session_destroy();

