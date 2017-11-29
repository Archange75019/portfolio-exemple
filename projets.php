<?php

//On récupère les projets et les affiche sur la vue
$aProjet = getProjet($pdo);


include'php/views/LayoutProjets.phtml';