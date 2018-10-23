<?php
    session_start();

    require('model/model.php');
    require('controller/controller.php');
    listArticle();
    //listArticleComments();


    // On teste la session à l'affichage

    /*if (isset($_SESSION['pseudonym']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['pseudonym'];
    }
    */

    //TEST des pages sous controller
    //getMemberConnexion();
    //require('../model/frontend.php');
    //require('../view/frontend/connexionview.php')

    //disconnectionMember();
    //require('../model/model.php');
