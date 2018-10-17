
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ma page d'inscription</title>
    <link href="css/style.css" rel="stylesheet" /> 
    </head>

    <body>
        <h1>Inscription</h1>

        <!-- Formulaire de création du compte membre-->
        <em><p>Création de votre espace membre</p></em>
        <form action="inscription.php" method="post">
            <p>Votre pseudo : <input type="text" name="pseudonym" /></p>
            <p> Votre email : <input type="text" name="email" /></p>
            <p>Votre mot de passe : <input type="text" name="password" /></p>
            <p> Confirmer votre mot de passe : <input type="text" name="confirmpassword" /></p>
            <p><input type="submit" value="OK"></p>
        </form>

        <!-- On récupère le détail du billet sélectionné-->
        <p><a href="/index.php">Retour à la liste des billets</a></p>

    </body>
</html>