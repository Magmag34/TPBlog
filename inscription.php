<?php
     session_start();

    // DB Acces  TPBlog
    require('model.php');

    $req = getPosts();
    $bdd = getConnexionBDD();

    if (isset($_POST["pseudo"])){
   
        // Vérification de la validité des informations
        $error = false;
        $pseudo = $_POST["pseudo"];
        $email = $_POST["email"];


        // Vérification d'un pseudo unique

        $req = $bdd->prepare('SELECT count(id) AS nbre_occurences FROM membres WHERE pseudonyme = :pseudo');
        $req->execute(array('pseudo' => $_POST['pseudo']));
         
        $donnees = $req->fetch();
        $nbre_occurences = $donnees['nbre_occurences'];
        $req->closeCursor();
        if ($nbre_occurences == 0)
        {
            //echo 'pseudo conforme';
        }
        else
        {
            echo "Le pseudo existe déjà, merci de choisir un autre pseudo.";
            $error = true;
        }
    

        // Vérification du formatage du mail

         $email = $_POST['email'];
     
        if (preg_match('#[a-z0-9\.-_]{1,}\@[a-z0-9\.-_]{1,}\.[a-z]{1,}#', $email)) {
           // echo 'Mail conforme';
        }
        
        else {
            echo "La définition de votre email n'est pas conforme au format attendu, de type dupond@gmail.com.";
            $error = true;
        }   
     
     
            // Vérification du formatage du mot de passe

        $password = $_POST['password'];
     
        if (preg_match('#[a-zA-Z]{4,}#', $password)) {
           // echo 'Mot de passe conforme';
        }
        
        else {
            echo "Le choix de votre mot de passe n'est pas conforme au format attendu.";
            $error = true;
        }   
        
        $confirmpassword = $_POST['confirmpassword'];

        // Confirmation du mot de passe
     
        if ( $password == $confirmpassword) {
           // echo 'Confirmation correcte';
        }
        
        else {
            echo 'La confirmation de votre mot de passe est incorrecte';
            $error = true;
        } 
   

       // Hachage du mot de passe
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);


         // Insertion des valeurs
        if (!$error) {
            $req = $bdd->prepare('INSERT INTO membres(pseudonyme, password, email) VALUES(:pseudo, :pass, :email);');
            $result = $req->execute(array(
            'pseudo' => $pseudo,
            'pass' => $pass_hache,
            'email' => $email));

        if ($result != 1 && $req->errorInfo()[1] == 1062) {
                echo("merci de rentrer un email unique");
            } 
    
        // Mise en place de la session
           
       if ($result == true) {
          
            $_SESSION['membres'] = $POST['pseudo'] ;

            // Redirection vers page Accueil
            header("Location: index.php");

            }
        else{
            echo 'erreur';
            }
        }
    }
    if (!isset($_SESSION['membres']))
        {
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ma page d'inscription</title>
    <link href="style.css" rel="stylesheet" /> 
    </head>

    <body>
        <h1>Inscription</h1>

        <!-- Formulaire de création du compte membre-->
        <em><p>Création de votre espace membre</p></em>
        <form action="inscription.php" method="post">
            <p>Votre pseudo : <input type="text" name="pseudo" /></p>
            <p> Votre email : <input type="text" name="email" /></p>
            <p>Votre mot de passe : <input type="text" name="password" /></p>
            <p> Confirmer votre mot de passe : <input type="text" name="confirmpassword" /></p>
            <p><input type="submit" value="OK"></p>
        </form>

        <!-- On récupère le détail du billet sélectionné-->
        <p><a href="index.php">Retour à la liste des billets</a></p>

    </body>
</html>

    <?php
        }
        else{
        echo 'Bonjour, votre numéro de session est:' . $_SESSION['membres'];
        }

    ?>

