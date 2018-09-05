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
// Vérification de la validité des informations
$pseudo=$_POST["pseudo"];
$email=$_POST["email"];

// Hachage du mot de passe
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

// Insertion
try
    {
        $req = $bdd->prepare('INSERT INTO membres(pseudonyme, password, email) VALUES(:pseudo, :pass, :email);');
        $result=$req->execute(array(
        'pseudo' => $pseudo,
        'pass' => $pass_hache,
        'email' => $email));
        var_dump($result);
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
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
            <p>Votre mot de passe : <input type="text" name="password" /></p>
            <p> Confirmer votre mot de passe : <input type="text" name="password" /></p>
            <p> Votre email : <input type="text" name="email" /></p>
            <p><input type="submit" value="OK"></p>
        </form>

        <!-- On récupère le détail du billet sélectionné-->
        <p><a href="index.php">Retour à la liste des billets</a></p>

    </body>
</html>