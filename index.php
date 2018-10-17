<?php
    session_start();

    require('model/frontend.php');

    $articles = getArticles();

    require('view/frontend/indexview.php');

    // On teste la session à l'affichage

    /*if (isset($_SESSION['pseudonym']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['pseudonym'];
    }
    */

