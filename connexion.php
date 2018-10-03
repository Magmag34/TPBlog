<?php
     session_start();

    // DB Acces  TPBlog
    require('model.php');

    $req = getPosts();


    if (isset($_POST["email"])) {
   
        // Vérification de la validité des informations
        $error = false;

        $resultat = getMember();
        var_dump($resultat);
        var_dump($_POST);
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

        if (!$resultat)
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
        else
        {
            if ($isPasswordCorrect) {
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['email'] = $email;
                echo 'Vous êtes connecté !';
            }
            else {
                echo 'plop!';
            }
        }
      }
// Mise en place de la session

  /*  session_start();

    $cookie_name = "membre";
    // On génère quelque chose d'aléatoire
    $membre = session_id().microtime().rand(0,9999999999);
    // on hash pour avoir quelque chose de propre qui aura toujours la même forme
    $membre = hash('sha512', $membre);

    // On enregistre des deux cotés
    setcookie($cookie_name, $membre, time() + (60 * 20)); // Expire au bout de 20 min
    $_SESSION['membre'] = $membre;

// Vérification de l'acceptation des cookies

    setcookie($name, $value, $time);

    if(!isset($_COOKIE[$name])) {
        // Le navigateur ne semble pas accepter les cookies
    }
*/
          echo password_hash('raphael2018', PASSWORD_DEFAULT);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ma page de connexion</title>
    <link href="style.css" rel="stylesheet" /> 
    </head>

    <body>
        <h1>Connexion</h1>

        <!-- Formulaire de connexion du membre-->
        <em><p>Connexion à votre espace membre</p></em>
        <form action="connexion.php" method="post">
            <p> Votre email : <input type="text" name="email" /></p>
            <p>Votre mot de passe : <input type="text" name="password" /></p>
            <p><input type="submit" value="OK"></p>
        </form>

        <!-- On récupère le détail du billet sélectionné-->
        <p><a href="index.php">Retour à la liste des billets</a></p>

    </body>
</html>
