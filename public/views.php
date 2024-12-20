<?php

require "config.php";

if (isset($_GET['idArticle'])) {

    $idArticle = intval($_GET['idArticle']);

    $stmtt = mysqli_query($connexion, "SELECT views FROM article WHERE id_article = $idArticle");
    $currentVal = mysqli_fetch_assoc($stmtt);
    $newView = intval($currentVal['views']) + 1;

    mysqli_query($connexion, "UPDATE article SET views = $newView WHERE id_article = $idArticle");

    header("Location: pageDetaile.php?idArticle=" . urlencode($idArticle));
    
}


?>