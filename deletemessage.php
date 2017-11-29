<?php

if (isset($_GET['id'])){
    $aMessId = array(
        ':id'=>$_GET['id']
    );

//On sélectionne l'id de l'article à supprimer
    $dMess= delmess($pdo, $aMessId);


    // et on supprime
}
header('Location: index.php?page=membre');
exit();