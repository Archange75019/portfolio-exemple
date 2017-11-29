<?php

if (isset($_GET['id'])){
    $aId = array(
          ':id'=>$_GET['id']
);

//On sélectionne l'id de l'article à supprimer
    $dPost= delpost($pdo, $aId);
   // et on supprime
}
header('Location: index.php?page=membre');
exit();