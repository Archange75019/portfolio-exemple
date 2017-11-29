<?php

if($_GET['id']){
    //On récupère l'id de l'avis sélectionné
    $avi=array(
        ':id' =>$_GET['id']
    );
    $aAvi= delavi($pdo, $avi);

}
header('Location: index.php?page=membre');
exit();