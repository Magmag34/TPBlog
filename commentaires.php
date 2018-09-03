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
        <title>Mon blog avec commentaires</title>
	<link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    <?php
    // On récupère les 5 derniers billets
    ?>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
        <p>
        <strong>Billet</strong> : <?php echo $donnees['titre']; ?><br />
        Contenu du Billet : <?php echo $donnees['contenu']; ?>,
        <em>Date du Billet : <?php echo $donnees['date_creation']; ?>,</em>

<?php
    // On récupère les commentaires du billet sélectionné
$req = $bdd->prepare('SELECT * FROM commentaires WHERE id = ?');

    // On récupère l'id contenu dans l'URL
$req->execute(array($_GET['id']));
$donnees= $req->fetch();
?>
        <!-- Mise en place du lien vers la page Commentaire -->
       </p>

        <p>Liste des mes commentaires</p>
        <p>
        <strong></strong> : <?php echo $donnees['auteur']; ?><br />
        Contenu du Billet : <?php echo $donnees['commentaire']; ?>,
        <em>Date du Billet : <?php echo $donnees['date_creation']; ?>,</em>


        <!-- Mise en place du lien vers la page Commentaire -->
        <a href="commentaires.php?id=<?php echo $donnees['id']; ?>">Commentaire de ce billet</a>
       </p>

    </body>
</html>