<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog avec commentaires</title>
    <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p>Derniers billets du blog :</p>
 
<?php
    // Connexion à ma base de données TPBlog
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=TPBlog;charset=utf8', 'tpblog', 'tpblog');
        echo "connexion réussie";
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
?>
    </body>
</html>