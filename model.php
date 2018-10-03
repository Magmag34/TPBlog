<!-- DB Acces -->
<?php
	function getPosts()
	{
		$bdd = getConnexionBDD();

		$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_creation DESC LIMIT 0, 5');

		return $req;
	}
	function getMember()
	{
		$bdd = getConnexionBDD();

		$email = $_POST["email"];
        $pass = $_POST["password"];
        

        //  Récupération de l'utilisateur et de son pass hashé
        $req = $bdd->prepare('SELECT id, password FROM membres WHERE email = :email');
        $req->execute(array(
            'email' => $email));
        $resultat = $req->fetch();

		return $resultat;
	}
	function getConnexionBDD()
	{
		try
		{
		    $bdd = new PDO('mysql:host=localhost;dbname=TPBlog;charset=utf8', 'tpblog', 'tpblog');
		}
		catch(Exception $exception)
		{
		    die('Erreur : '.$exception->getMessage());
		}
		return $bdd;

	}
