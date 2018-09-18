<?php
    // Connexion à ma base de données TPBlog
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=TPBlog;charset=utf8', 'tpblog', 'tpblog');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
?>

<?php 
    if (isset($_POST["pseudo"])) {
   

        // Vérification de la validité des informations
        $error = false;

        $pseudo = $_POST["pseudo"];
        $email = $_POST["email"];


        // Vérification d'un pseudo unique

        $req = $bdd->prepare('SELECT count(id) AS nbre_occurences FROM membres WHERE pseudo = :login');
        $req->execute(array('login' => $_POST['login']));
         
        $donnees = $req->fetch();
        $nbre_occurences = $donnees['nbre_occurences'];
        $req->closeCursor();
             
        if ($nbre_occurences == 0)
        {
            echo 'pseudo conforme';
        }
        else
        {
            echo "Le pseudo existe déjà, merci de choisir un autre pseudo.";
            $error = true;
        }
    

        // Vérification du formatage du mail

         $email = $_POST['email'];
     
        if (preg_match('#[a-z0-9\.-_]{1,}\@[a-z0-9\.-_]{1,}\.[a-z]{1,}#', $email)) {
            echo 'Mail conforme';
        }
        
        else {
            echo "La définition de votre email n'est pas conforme au format attendu, de type dupond@gmail.com.";
            $error = true;
        }   
     
     
            // Vérification du formatage du mot de passe

        $password = $_POST['password'];
     
        if (preg_match('#[a-zA-Z]{4,}#', $password)) {
            echo 'Mot de passe conforme';
        }
        
        else {
            echo "Le choix de votre mot de passe n'est pas conforme au format attendu.";
            $error = true;
        }   
        
        $confirmpassword = $_POST['confirmpassword'];

        // Confirmation du mot de passe
     
        if ( $password == $confirmpassword) {
            echo 'Confirmation correcte';
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

       /* session_start();

        $cookie_name = "membre";
        // On génère quelque chose d'aléatoire
        $membre = session_id().microtime().rand(0,9999999999);
        // on hash pour avoir quelque chose de propre qui aura toujours la même forme
        $membre = hash('sha512', $membre);

        // On enregistre des deux cotés
        setcookie($cookie_name, $membre, time() + (60 * 20)); // Expire au bout de 20 min
        $_SESSION['membre'] = $membre;*/

        }
    }
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

