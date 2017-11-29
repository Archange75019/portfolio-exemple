<?php
//Mise à jour du projet en fonction de l'id
if(ctype_digit($_GET['id'])){
    $id=array(
        ':id' =>$_GET['id']

    );
    //récupération du projet en base
    $aPopProjet= GetProjetId($pdo, $id);
}else{
    echo 'ID invalide';
}

if (isset($_POST['article'])) {

//Si le formulaire a été soumis
        $aModifArticle = array(
            ':id' => $_GET['id'],
            ':titre' => $_POST['titre'],
            ':contenu' => $_POST['input']



        );
        $update = updateArticle($pdo, $aModifArticle);
    $aPopProjet= GetProjetId($pdo, $id);
//Mise à jour du projet

    }


include 'php/views/Layoutpopup.phtml';