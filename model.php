<!-- DB Acces -->

<?php
	function getBillets()
	{
		try
		{
		    $bdd = new PDO('mysql:host=localhost;dbname=TPBlog;charset=utf8', 'tpblog', 'tpblog');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_creation DESC LIMIT 0, 5');

		return $req;
	}
