<?php
    session_start();

    require('../model/frontend.php');

    $article = getArticleByID($_GET['id']);
    $comments = getCommentsByArticleId($_GET['id']);

    require('../view/frontend/commentview.php');
  
?>

