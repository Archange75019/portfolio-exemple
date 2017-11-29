<?php


 function PostComp($monPdo, $aParams)
{

    $query = $monPdo->prepare('UPDATE competences SET HtmlCss=:html, PhpMysql=:php, Js=:js WHERE id=0');
    $query->execute($aParams);
    return $query->fetchall();

}
function postPresent($monPdo, $aPresent)
{
    $query = $monPdo->prepare('UPDATE presentation SET titre=:titre, contenu=:contenu WHERE id=1');
    $query->execute($aPresent);
    return $query->fetchall();

}
function postArticle($monPdo, $aArticle)
{
    $query = $monPdo->prepare('INSERT INTO projets (titre, contenu, date) VALUES(:titre, :contenu, NOW())');
    $query->execute($aArticle);
    return $query->fetchall();

}

function delPost($monPdo, $aId)
{
    $query = $monPdo->prepare('DELETE FROM projets WHERE id=:id');
    $query->execute($aId);
    return $query->fetchall();
}
function delmess($monPdo, $aMessId)
{

    $query = $monPdo->prepare('DELETE FROM contact WHERE id=:id');
    $query->execute($aMessId);
    return $query->fetchall();
}
function delavi ($monPdo, $avi)
{
    $query = $monPdo->prepare('DELETE FROM avis WHERE id = :id');
    $query->execute($avi);
    return $query->fetchall();
}

function updateArticle($monPdo,$aModifArticle)
{
    $query = $monPdo->prepare('UPDATE projets SET titre=:titre, contenu=:contenu WHERE id=:id ');
    $query->execute($aModifArticle);
    return $query->fetchall();
}
function postContact($monPdo, $aContact)
{
    $query = $monPdo->prepare('INSERT INTO contact (nom, prenom, mail, message, date) VALUES(:nom, :prenom, :mail, :message, NOW())');
    $query->execute($aContact);
    return $query->fetchall();
}
function addUsers ($monPdo,$aentre)
{

    $query = $monPdo->prepare('INSERT into company (entreprise, email, mdp, interlocuteur) VALUES (:compagny, :Email, :mdp, :interlocuteur)');
    $query->execute($aentre);
    return $query->fetchall();

}
function delUser ($monPdo,$aDelUser)
{

    $query = $monPdo->prepare('DELETE FROM company WHERE email = :user ');
    $query->execute($aDelUser);
    return $query->fetchall();

}

