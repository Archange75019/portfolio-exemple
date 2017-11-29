<?php

//Si le formulaire de la page contact à été soumis

if (isset($_POST["contact"])) {

    if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail'])) {

//On récupère les données dans un tableau
        $aContact = array(

            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':mail' => $_POST['mail'],
            ':message' => $_POST['message']


        );
        //On stocke en base et on redirige vers la page home
        $aMessage = postContact($pdo, $aContact);
        header('Location: index.php?page=home');
        exit();
    }


}
include 'php/views/LayoutContact.phtml';