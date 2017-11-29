<?php
//Si l'ID en url est bien un entier
if (ctype_digit($_GET['id'])){

    // on le récupère dans un tableau
    $aArticle=array(
        ':id' =>$_GET['id']
    );
// On va chercher l'article en fonction de l'id
    $aArticleFull = afficheArticle($pdo, $aArticle);

}
if ($aArticleFull==false){
    $articleabs = "Article inconnu";

}

include 'php/views/LayoutArticle.phtml';