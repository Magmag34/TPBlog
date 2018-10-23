<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>    

<h1>Mon super blog !</h1>
<p>Les billets du blog :</p>

<?php
$index = 0;

while ($index < count($articles))
{
?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($articles[$index]['title']); ?>
        <em>le <?php echo $articles[$index]['creation_date_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($articles[$index]['content']));
    ?>
    <br />
    <em><a href="controller/comment.php?id=<?php echo $articles[$index]['id']; ?>">Commentaire de ce billet</a></em>
    </p>

</div>
<?php
    $index++;
}

if(isset($_SESSION['pseudonym'])){
    ?>
    <a href="controller/deconnexion.php">Deconnexion</a>  
    <--!A MODIFIER SELON ACTION-->      
    <?php
} else {
    ?>
    <a href="?action=inscription">S'inscrire</a>/<a href="controller/connexion.php">Connexion</a>
    <--!A MODIFIER SELON ACTION--> 
    <?php
}
?>
<?php $page = ob_get_clean(); ?>

<?php require('view/template.php'); ?>