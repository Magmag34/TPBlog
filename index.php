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
    // On récupère les 5 derniers billets
$reponse = $bdd->query('SELECT * FROM billets ORDER BY id DESC LIMIT 0, 5');
?>

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
    // On affiche le contenu du billet
    while ($donnees = $reponse->fetch())
    {
    ?>
        <p>
        <strong>Billet</strong> : <?php echo $donnees['titre']; ?><br />
        Contenu du Billet : <?php echo $donnees['contenu']; ?><br />
        <em>Date du Billet : <?php echo $donnees['date_creation']; ?>,</em>
        <!-- Mise en place du lien vers la page Commentaire -->
        <a href="commentaires.php?id=<?php echo $donnees['id']; ?>">Commentaire de ce billet</a>
       </p>

    <?php
         // Fin de la boucle des billets

    }
    // Termine le traitement de la requête

    $reponse->closeCursor(); 

?>
    <a href="inscription.php">S'inscrire</a>

    </body>
</html>