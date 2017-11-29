<?php



if(isset($_POST) && !empty($_POST['recherche'])) {
//On soumet le formulaire et on vérifie que le champ ne soit pas vide

    $aSearchResult = searchResult($pdo);

    if ($aSearchResult<1) {


        echo 'Pas de résultat';
}





}




include 'php/views/LayoutResult.phtml';
