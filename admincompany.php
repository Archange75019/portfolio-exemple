<?php


session_start();

/*
si la variable de session user n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if(!isset($_SESSION['user'])) {
    echo 'Vous n\'êtes pas autorisé à accéder à cette zone';
    header('Location: index.php?page=company');
    exit();
}


if( isset($_POST['envoi']) ) // si formulaire soumis
{
//constantes
    $dossier = 'assets/uploads/';
    $fichier = basename($_FILES['image']['name']);
// Si la variable $fichier est vide on choisi un autre dossier et un fichier
    if (empty($fichier)){
        $dossier = 'assets/uploads/logo/';
        $fichier = basename('assets/uploads/logo/blank.jpg');

        $aAvis = array(
//Correpondance entre les données saisie et les variable PDO

            ':titre' => $_POST['titre'],
            ':rating' => $_POST['notesA'],
            ':file' => $dossier.$fichier,
            ':detail' => $_POST['detail']


        );
// On inscrit en base les données

        $putFile = putAvis($pdo, $aAvis);
//On supprime l'utilisateur
        $aDelUser = array(
            ':user' => $_SESSION['user']
        );
        $Deluser = delUser($pdo, $aDelUser );
//On redirige vers la page home
        header('Location: index.php?page=home');
//On stoppe l'execution du code
        exit();
    }
// Si la variable $fichier n'est pas vide
// On défini la taille du fichier en octets image admissible
    $taille_maxi = 1048576;
// On récupère la taille de l'image
    $taille = filesize($_FILES['image']['tmp_name']);
//On défini les extensions admissibles
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
// On récupère l'extension du fichier envoyé
    $extension = strrchr($_FILES['image']['name'], '.');



    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg';
    }
    if($taille>$taille_maxi)
    {
        $erreur = 'Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        //formatage du nom (suppression des accents, remplacements des espaces par "-")
        $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //correct si la fonction renvoie TRUE
        {
            $aAvis = array(
//Correpondance entre les données saisie et les variable PDO

                ':titre' => $_POST['titre'],
                ':rating' => $_POST['notesA'],
                ':file' => $dossier.$fichier,
                ':detail' => $_POST['detail']


            );


            $putFile = putAvis($pdo, $aAvis);

            $aDelUser = array(
                ':user' => $_SESSION['user']
            );
            $Deluser = delUser($pdo, $aDelUser );
            header('Location: index.php?page=home');


        } else //sinon, cas où la fonction renvoie FALSE
        {
            echo 'Echec de l\'upload !';
        }
    }
    else
    {
        echo $erreur;
    }




}
















include 'php/views/company/LayoutCompanyAvis.phtml';