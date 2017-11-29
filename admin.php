<?php



// on teste si le visiteur a soumis le formulaire de connexion

if ((sizeof($_POST)>0)&& isset($_POST['connexion'])) {
// On crypte le mots de pass avec la fonction sha1 de php
    $_POST['pass'] = sha1($_POST['pass']);
    $a = array(
//Correpondance entre les données saisie et les variable PDO
        ':pseudo' => $_POST['pseudo'],
        ':pass' => $_POST['pass']


    );


    $result = Getaccess($pdo, $a);
    //On appel cette fonction pour vérifier la présence
    // du couple user/ mots de pass dans la base
    //Dans la vue j'utilise les fonctions suivantes pour me protéger des failles
    // sql en ce qui concerne l' authentification
    // stripcslashes: qui supprime les antislashs
    // htmlspecialchars: Convertit les caractères spéciaux en éléments html,
    // le flags ENT NOquotes ignore les guillemets doubles et simples



//si la fonction retourne un résultat on redirige vers la page membre
    if ($result["count(*)"]==1) {
       session_start();
       $_SESSION['pseudo'] = $_POST['pseudo'];
        header('Location: index.php?page=membre');
        exit();

//sinon
    } else {
        echo'identification incorrecte';

    }

}


include 'php/views/admin/LayoutConnect.phtml';








