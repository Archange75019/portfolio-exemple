<?php


session_start();

/*
si la variable de session user n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if(!isset($_SESSION['pseudo'])) {
    echo 'Vous n\'êtes pas autorisé à accéder à cette zone';
    header('Location: index.php?page=admin');
    exit();
}








    if (isset($_POST['Envoyer'])) {
//On récupère les pourcentages de compétences
        $aParams = array(

            ':html' => $_POST['html'],
            ':php' => $_POST['php'],
            ':js' => $_POST['js']

        );


        //mise à jour des valeurs de la table compétence


        $aPostComp = PostComp($pdo, $aParams);


    }
//mise à jour de la présentation

    if(isset($_POST['presentation'])) {

        $aPresent = array(

            ':titre' => $_POST['titre'],
            ':contenu' => $_POST['contenu']


        );



//On poste la présentation
        $aPostPresent = postPresent($pdo, $aPresent);


    }
    //insertion d'article
    if (isset($_POST['article'])) {


        $aArticle = array(
            ':titre' => $_POST['titre'],

            ':contenu' => $_POST['input']

        );



        $aPostArticle = postArticle($pdo, $aArticle);

    }
if (isset($_POST['AjoutUser'])) {
    $pass1 = $_POST['Mdp'];
    $genre = $_POST['sexe'];
    $interlocuteur =$_POST['NomInterlocuteur'];
    $_POST['Mdp'] = sha1($_POST['Mdp']);

    $aentre = array(

        ':interlocuteur' => $_POST['NomInterlocuteur'],

        ':compagny' => $_POST['NomCompagny'],
        ':mdp' =>$_POST['Mdp'],
        ':Email' =>$_POST['EmailInterlocuteur']


    );

    if(isset($_POST['AjoutUser'])){

        $nom  = $_POST['EmailInterlocuteur'];

        $mail = $_POST['EmailInterlocuteur']; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
            $passage_ligne = "\r\n";
        }
        else
        {
            $passage_ligne = "\n";
        }
//=====Déclaration des messages au format HTML.

        $message_html = "<html>
                            <head>
                                <style>
                               body{
                               text-align: center;
                               width: 100%;
                               }
                                p{
                                color: black;
                                }
                                h1  {
                                text-align: center;
                                color: #264272;
                                width: 100%;
                                }
                                </style>
                            </head>
                            <body>
                                <br>
                                <h1>Enquête de satisfaction</h1></br>
                                <p>".$genre ." ". $interlocuteur."</p>
                                <p>Veuillez trouver ci-dessous les informations qui vous permettront de me 
                                laisser votre avis concernant le travail que j'ai effectué pour vous</p>
                                <h3> nom d'utilisateur: " .$nom. "</h3>
                                <h3>mot de passe: ".$pass1."</h3> 
                                <p>Page de connection: http://http://portfolio-arnaud.comli.com/index.php?page=company</p>
                                <p>Les réponses à ce mail ne me parviendront pas</p>
                            </body>
                          </html>";
//==========

//=====Création de la boundary
        $boundary = "-----=".md5(rand());
//==========

//=====Définition du sujet.
        $sujet = "Enquête de satisfaction";
//=========

//=====Création du header de l'e-mail.
        $header = "From: \"Arnaud Escalier\"<portfolio-arnaud@portfolio.fr>".$passage_ligne;
        $header.= "Reply-to: \"Arnaud Escalier\" <portfolio-arnaud@portfolio.fr>".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
        $message = $passage_ligne."--".$boundary.$passage_ligne;
//==========
        $message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;
//==========
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
        mail($mail,$sujet,$message,$header);
//==========

    }

    $aAddEntreprise = addUsers($pdo, $aentre);

}



$aPresent = getPresent($pdo);
$aProjet = getProjet($pdo);
$aCont = getCont($pdo);

$aAvis = GetAvis($pdo);







include 'php/views/admin/LayoutAffiche.phtml';