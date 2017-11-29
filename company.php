<?php
if ((sizeof($_POST)>0)&& isset($_POST['connexion'])) {

// On crypte le mots de pass avec la fonction sha1 de php

    $_POST['pass'] = sha1($_POST['pass']);
    $pass = array(
//Correpondance entre les données saisie et les variable PDO
        ':email' => $_POST['user'],
        ':pass' => $_POST['pass']


    );


    $comp = Getcompany($pdo, $pass);



    if ($comp["count(*)"]==1) {


        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: index.php?page=admincompany');
        exit();

//sinon
    } else {
        echo'identification incorrecte';

    }
}


include 'php/views/company/LayoutConnectCompany.phtml';