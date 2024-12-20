<?php

require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $idArticle = intval($_GET['idArticle']);
    echo $_POST["name"];
    $stmt = mysqli_query($connexion, "SELECT likes FROM article WHERE id_article = $idArticle");
    $currentValue = mysqli_fetch_assoc($stmt);
    $newLike = intval($currentValue['likes']) + 1;

    mysqli_query($connexion, "UPDATE article SET likes = $newLike WHERE id_article = $idArticle");

    header("Location: pageDetaile.php?idArticle=" . urlencode($idArticle));
}


?>