<?php

use Slim\Slim;
use wishlist\Chemins;

$CSS = Chemins::$CSS;

echo <<< header
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>My Wishlist</title>

        <link href="$CSS/my-wishlist.css" rel="stylesheet">
    </head>
    <body>
        <header class="page-top">
            <div class="title">
                <a class="invisible-link" href=/>My wishlist</a>
                <a class="invisible-link" href=/listeCreateur>Liste des créateurs</a>
            </div>
            <span class=profile>
header;

if (!isset($_SESSION['pseudo'])) {
    $login  = Slim::getInstance()->urlFor('connexion');
    $signup = Slim::getInstance()->urlFor('inscription');

    echo <<< end
        <a class="invisible-link" href='$login'>Se connecter</a> ou <a class="invisible-link" href='$signup'>s'inscrire</a>
    end;
} else {
    $JS     = Chemins::$JS;
    $profil = Slim::getInstance()->urlFor('affichageProfil');
    $pseudo = $_SESSION['pseudo'];

    echo <<< end
        Bienvenue <a class="invisible-link" href='$profil'>$pseudo</a> !
        <a class="invisible-link" href='javascript:logout()'>Se déconnecter</a>

        <script async src="$JS/profil.js"></script>
    end;
}

echo <<< header
            </span>
        </header>
        <div class="header-line"></div>
        <div id=content>
header;

?>