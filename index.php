<?php

require 'php/connect.php';
require 'php/models/Get.php';
require 'php/models/Posts.php';
//on demande le chargement des fichiers de models



// système de routings
if (isset($_GET['page'])&& ctype_alpha($_GET['page']))
{
    // en fonction de la page demandé ...
    switch($_GET['page'])
    {
        case 'presentation' ;
        case 'projets' ;
        case 'contact' ;
        case 'home';
        case 'admin';
        case 'membre';
        case 'delete';
        case 'deletemessage';
        case 'popup';
        case 'mail';
        case 'search';
        case 'article';
        case 'deconnexion';
        case 'avis';
        case 'company';
        case 'admincompany';
        case 'ConsultAvis';
        case 'deleteavis';


            // .. on charge son controller 
            require 'php/inc/'.($_GET['page']).'.php';
            break;

        default :
            // chargement du controller page erreur 404
            require 'php/inc/error_404.php';
    }
}
// Sinon c'est la page d'accueil
else
{
    // chargement du controller (page d'accueil)
    require 'php/inc/home.php';
}
   