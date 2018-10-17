<?php
     session_start();

    // DB Acces  TPBlog
    require('../model/frontend.php');
    require('../view/frontend/connexionview.php');

    if (isset($_POST["email"])) {
   
        // Vérification de la validité des informations
        //$error = false;

        $resultat = getMember($_POST["email"], $_POST["password"]);
    
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

        if (!$resultat || !isPasswordCorrect) {
            echo 'Mauvais identifiant ou mot de passe !';
        } else {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['email'] = $resultat['email'];
            $_SESSION['pseudonym'] = $resultat['pseudonym'];
            //echo 'Vous êtes connecté !';
            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
        }
    }
?>