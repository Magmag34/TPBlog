
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
        <p><a href="/index.php">Retour à la liste des billets</a></p>

    </body>
</html>
