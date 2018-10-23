<?php
    function listArticle()
    {
        $articles = getArticles();
        require('view/frontend/indexview.php');
    }

    function listArticleComments()
    {
    	$article = getArticleByID($_GET['id']);
    	$comments = getCommentsByArticleId($_GET['id']);

    	require('view/frontend/commentview.php');
    }
  
    function addComment($post_id, $author, $content)
	{
	    $affectedLines = postComment($post_id, $author, $content);

	    if ($affectedLines === false) {
	        die('Impossible d\'ajouter le commentaire !');
	    }
	    else {
	        header('Location: index.php?action=post&id=' . $post_id);
	    }
	}

    function getMemberConnexion()
    {
        if (isset($_POST["email"])) {
            // Vérification de la validité des informations
            $resultat = getMember($_POST["email"], $_POST["password"]);
        
            // Comparaison du pass envoyé via le formulaire avec la base
            $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

            if (!$resultat || !isPasswordCorrect) {
                echo 'Mauvais identifiant ou mot de passe !';
            } else {
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['email'] = $resultat['email'];
                $_SESSION['pseudonym'] = $resultat['pseudonym'];
                //echo 'Vous êtes connecté !';
                echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
            }
        }
    }

    function getInscriptionMember()
    {
        $bdd = getConnexionBDD();
        
        if (isset($_POST["pseudonym"]))
        {
       
            // Vérification de la validité des informations
            $error = false;
            $pseudo = $_POST["pseudonym"];
            $email = $_POST["email"];


            // Vérification d'un pseudo unique

            $req = $bdd->prepare('SELECT count(id) AS nbre_occurences FROM membres WHERE pseudonym = :pseudonym');
            $req->execute(array('pseudonym' => $_POST['pseudonym']));
             
            $donnees = $req->fetch();
            $nbre_occurences = $donnees['nbre_occurences'];
            $req->closeCursor();
            
            if ($nbre_occurences == 0){} 
            else 
                {
                    echo "Le pseudo existe déjà, merci de choisir un autre pseudonyme.";
                    $error = true;
                }
            // Vérification du formatage du mail
            $email = $_POST['email'];
         
            if (preg_match('#[a-z0-9\.-_]{1,}\@[a-z0-9\.-_]{1,}\.[a-z]{1,}#', $email)) {} 
            else 
                {
                    echo "La définition de votre email n'est pas conforme au format attendu, de type dupond@gmail.com.";
                    $error = true;
                }   
         
            // Vérification du formatage du mot de passe

            $password = $_POST['password'];
         
            if (preg_match('#[a-zA-Z]{4,}#', $password)) {} 
            else 
                {
                echo "Votre mot de passe doit contenir au moins 4 caractères.";
                $error = true;
                }   
            
            $confirmpassword = $_POST['confirmpassword'];
            // Confirmation du mot de passe
         
            if ($password == $confirmpassword) {} 
            else
                {
                    echo 'La confirmation de votre mot de passe est incorrecte';
                    $error = true;
                } 
            
            // Hachage du mot de passe
            $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Insertion des valeurs
            if (!$error) 
                {
                    $req = $bdd->prepare('INSERT INTO membres(pseudonym, password, email) VALUES(:pseudonym, :pass, :email);');
                    $result = $req->execute(
                        [
                            'pseudonym' => $pseudonym,
                            'pass' => $pass_hache,
                            'email' => $email
                        ]
                    );

                    if ($result != 1 && $req->errorInfo()[1] == 1062) 
                    {
                        echo("merci de rentrer un email unique");
                    } 
                
                    // Mise en place de la session
                    if ($result == true)
                    {
                        $_SESSION['pseudonym'] = $_POST['pseudonym'] ;
                        // Redirection vers page Accueil
                        //header('location:index.php');
                        //https://www.developpez.net/forums/d744574/php/langage/syntaxe/redirection-utiliser-header/
                        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
                        exit();
                    } 
                    else {
                        echo 'erreur';
                    }
                }
        }
    }
?>

