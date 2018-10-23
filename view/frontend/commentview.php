<?php $title = 'Mes commentaires'; ?>
<?php ob_start(); ?>

<?php $page = ob_get_clean();?> 

    <!--On récupère le détail du billet sélectionné-->
        <p><a href="/index.php">Retour à la liste des billets</a></p>
        <p>
        <h2>Billet :</h2><?php echo $article['title']; ?><br />
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
        <h3>Liste des commentaires :</h3>
    </p>
<?php
    // On affiche le contenu des commentaires
    $index = 0;

    while ($index < count($comments))
    {
    ?>
        <p>
        <?php echo $comments[$index]['post_id']; ?><br />
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
    <h3>Ajouter votre nouveau commentaire à ce billet :</h3>

    <form action="index.php?action=postComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="content">Commentaire</label><br />
            <textarea id="content" name="content"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>


<?php require('view/template.php'); ?>