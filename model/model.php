<!-- DB Acces -->
<?php
	function getArticles()
	{
		$bdd = getConnexionBDD();

		$req = $bdd->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM article ORDER BY creation_date DESC LIMIT 0, 5');
		$req->execute(array(
		));
		$resultat = $req->fetchAll();

		return $resultat;
	}

	function getMember($email, $pass)
	{
		$bdd = getConnexionBDD();


        //  Récupération de l'utilisateur et de son pass hashé
        $req = $bdd->prepare('SELECT * FROM member WHERE email = :email');
        $req->execute(array(
            'email' => $email
        ));
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
	
	function getArticleByID($articleId)
	{
		$bdd = getConnexionBDD();
		$req = $bdd->prepare('SELECT * FROM article WHERE id = :id');
		$req->execute(array(
			'id' => $articleId
		));
		$resultat= $req->fetch();

		return $resultat;
	}

	function getCommentsByArticleId($articleId)
	{
		$bdd = getConnexionBDD();
		$req = $bdd->prepare('SELECT author, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, content FROM comment WHERE link_article_id = :id');
		$req->execute(array(
			'id' => $articleId
		));
		$resultat= $req->fetchAll();

		trigger_error(var_export($resultat, true));
		return $resultat;
	}

	function postComment($postId, $author, $content)
	{
	    $bdd = getConnexionBDD();
	    $comments = $bdd->prepare('INSERT INTO comment(id, author, content, comment_date) VALUES(?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $comment));

	    return $affectedLines;
	}










