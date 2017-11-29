<?php

if(ctype_digit($_GET['id'])){
//On récupère l'id du message sélectionné
$avis=array(
':id' =>$_GET['id']
);
//On récupère le message selon l'id sélectionné
$aAvis= GetAvisId($pdo, $avis);

}else{
    echo 'ID invalide';
}


//Intervient dans le cadre de la partie admin, appelé dans une popup pour consultation
include 'php/views/admin/layoutAvis.phtml';