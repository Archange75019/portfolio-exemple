<?php


//Si l'ID en url est bien un chiffre
if (ctype_digit($_GET['id'])){

    // on le récupère dans un tableau
    $aArticle=array(
        ':id' =>$_GET['id']
    );
// On va chercher l'article en fonction de l'id
    $aArticle = afficheArticle($pdo, $aArticle);

}

include 'php/views/LayoutArticleResult.phtml';