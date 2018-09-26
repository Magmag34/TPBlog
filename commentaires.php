<?php
    session_start();

    // DB Acces  TPBlog
    require('model.php');

    $req = getBillets();


?>
<?php
    // On récupère l'id du billet sélectionné
$req = $bdd->prepare('SELECT * FROM billets WHERE id = ?');
    // On récupère l'id contenu dans l'URL
$req->execute(array($_GET['id']));
$donnees= $req->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mes commentaires</title>
	<link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    <!-- On récupère le détail du billet sélectionné-->
        <p><a href="index.php">Retour à la liste des billets</a></p>
        <p>
        <strong>Billet</strong> : <?php echo $donnees['titre']; ?><br />
        Contenu du Billet : <?php echo $donnees['contenu']; ?><br />
        <em>Date du Billet : <?php echo $donnees['date_creation']; ?></em><br />
        <br />
<?php
    // On teste la session à l'affichage

    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        echo 'Bonjour, votre numéro de session est:" ' . $_SESSION['pseudo'];
    }

?>
<?php
    // On récupère les commentaires du billet sélectionné
$req = $bdd->prepare('SELECT * FROM commentaires WHERE id_billet = ?');

    // On récupère l'id contenu dans l'URL
$req->execute(array($_GET['id']));
?>       
    <p>
        <strong>Liste des mes commentaires :</strong><br />
    </p>
<?php
    // On affiche le contenu des commentaires

    while ($donnees = $req->fetch())
    {
    ?>
        <p>
        <?php echo $donnees['id']; ?><br />
        <em>Date du Commentaire : <?php echo $donnees['date_commentaire']; ?></em><br />
        Auteur du Commentaire : <?php echo $donnees['auteur']; ?><br />
        Contenu : <?php echo $donnees['commentaire']; ?><br />
       </p>
        <!-- Mise en place du lien vers la page Commentaire -->
       </p>

    <?php
         // Fin de la boucle des commentaires

    }
    // Termine le traitement de la requête

    $req->closeCursor(); 

?>
    </body>
</html>