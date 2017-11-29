<?php
function GetComp($monPdo)
{
    $query = $monPdo->prepare('SELECT * FROM competences');
    $query->execute();
    return $query->fetchall();
}
function getPresent($monPdo)
{
    $query = $monPdo->prepare('SELECT * FROM presentation');
    $query->execute();
    return $query->fetchall();
}
function getProjet($monPdo)
{
    $query = $monPdo->prepare('SELECT * FROM projets');
    $query->execute();
    return $query->fetchall();

}

function Getaccess($monPdo,$a)
{
    $query = $monPdo->prepare('SELECT count(*) FROM users WHERE pseudo=:pseudo AND pass=:pass');
    $query->execute($a);
     return $result=$query->fetch(PDO::FETCH_ASSOC);

}
function Getcompany($monPdo,$pass)
{
    $query = $monPdo->prepare('SELECT count(*) FROM company WHERE email=:email AND mdp=:pass');
    $query->execute($pass);
    return $result=$query->fetch(PDO::FETCH_ASSOC);

}

function getCont($monPdo)
{
    $query = $monPdo->prepare('SELECT * FROM contact');
    $query->execute();
    return $query->fetchall();
}
function GetProjetId($monPdo, $id)
{
    $query = $monPdo->prepare('SELECT * FROM projets WHERE id=:id');
    $query->execute($id);
    return $query->fetchall();
}
function GetMess($monPdo, $mail)
{
    $query = $monPdo->prepare('SELECT * FROM contact WHERE id=:id ');
    $query->execute($mail);
    return $query->fetchall();
}
function searchResult($monPdo)

{
    $aRecherche = $_POST['recherche'];
    $tab = explode(' ' , $aRecherche);
    $recherche1 = "%".$tab[0]."%";

    $query = $monPdo->prepare('SELECT titre, contenu, id, date  FROM projets WHERE contenu LIKE :recherche' );

    $query->bindParam(':recherche' , $recherche1);
    //var_dump($Search);

    $query->execute();




    return $query->fetchall();




}
function GetAvis ($monPdo)
{
    $query = $monPdo->prepare('SELECT * FROM avis');
    $query->execute();
    return $query->fetchall();
}
function GetAvisId ($monPdo, $avis)
{
    $query = $monPdo->prepare('SELECT * FROM avis WHERE id = :id');
    $query->execute($avis);
    return $query->fetchall();
}

function putAvis ($monPdo, $aAvis)
{
    $query = $monPdo->prepare('INSERT into avis (note, titre, contenu, img) VALUES (:rating, :titre, :detail, :file)');
    $query->execute($aAvis);
    return $query->fetchall();
}

function afficheArticle($monPdo, $aArticle)
{
    $query = $monPdo->prepare('SELECT * FROM projets WHERE id=:id ');
    $query->execute($aArticle);
    return $query->fetchall();
}