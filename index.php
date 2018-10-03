<?php
    session_start();

    // DB Acces  TPBlog
    require('model.php');

    $req = getPosts();
    $bdd = getConnexionBDD();

    require('indexview.php');

    // On teste la session à l'affichage

    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['pseudo'];
    }


