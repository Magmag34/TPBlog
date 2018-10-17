<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mes commentaires</title>
    <link href="css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    <!-- On récupère le détail du billet sélectionné-->
        <p><a href="/index.php">Retour à la liste des billets</a></p>
        <p>
        <strong>Billet</strong> : <?php echo $article['title']; ?><br />
        Contenu du Billet : <?php echo $article['content']; ?><br />
        <em>Date du Billet : <?php echo $article['creation_date']; ?></em><br />
        <br />
<?php
    // On teste la session à l'affichage

    if (isset($_SESSION['id']) AND isset($_SESSION['pseudonym']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['pseudonym'];
    }
?>       
    <p>
        <strong>Liste des mes commentaires :</strong><br />
    </p>
<?php
    // On affiche le contenu des commentaires
    $index = 0;

    while ($index < count($comments))
    {
    ?>
        <p>
        <?php echo $comments[$index]['id']; ?><br />
        <em>Date du Commentaire : <?php echo $comments[$index]['comment_date_fr']; ?></em><br />
        Auteur du Commentaire : <?php echo $comments[$index]['author']; ?><br />
        Contenu : <?php echo $comments[$index]['content']; ?><br />
       </p>
        <!-- Mise en place du lien vers la page Commentaire -->
       </p>

    <?php
        $index++;
         // Fin de la boucle des commentaires
    }

?>
    </body>
</html>