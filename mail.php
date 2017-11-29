<?php


if(ctype_digit($_GET['id'])){
    //On récupère l'id du message sélectionné
    $mail=array(
        ':id' =>$_GET['id']
    );
    //On récupère le message selon l'id sélectionné
    $aMail= GetMess($pdo, $mail);

}else{
    echo 'ID invalide';
}
if(isset($_POST['message'])){

    $destinataire = $_POST['mail'];
// Adresse email du destinataire
    $sujet = $_POST['Sujet'];
// Titre de l'email
    $message = $_POST['reponse'];
// Contenu du message de l'email
    mail($destinataire, $sujet, $message);
// Fonction principale qui envoi l'email
    echo 'Email envoyé!';

}
include 'php/views/LayoutMail.phtml';