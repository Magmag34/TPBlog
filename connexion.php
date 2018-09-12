<?php 

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

// Mise en place de la session

    session_start();

    $cookie_name = "membre";
    // On génère quelque chose d'aléatoire
    $membre = session_id().microtime().rand(0,9999999999);
    // on hash pour avoir quelque chose de propre qui aura toujours la même forme
    $membre = hash('sha512', $membre);

    // On enregistre des deux cotés
    setcookie($cookie_name, $membre, time() + (60 * 20)); // Expire au bout de 20 min
    $_SESSION['membre'] = $membre;

// Vérification de l'acceptation des cookies

    setcookie($name, $value, $time);

    if(!isset($_COOKIE[$name])) {
        // Le navigateur ne semble pas accepter les cookies
    }

?>