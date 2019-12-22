<?php

namespace wishlist\controllers;

use wishlist\views as v;
use Slim\Http\Response;
use Slim\Slim;
use wishlist\models\Utilisateur;

class Profil {
    public function pageConnexion() {
        (new v\ProfilConnexion())::afficher();
    }

    public function pageInscription() {
        (new v\ProfilInscription())::afficher();
    }

    // 17 : creer un compte : OK
    public function créerCompte($pseudo, $mdp) {
        $l = new Utilisateur();
        $l->pseudo = $pseudo;
        $l->pass = $mdp;
        $l->save();

        $_SESSION['pseudo'] = $pseudo;
    }

    public function connexion($pseudo, $checked) {
        $app = Slim::getInstance();
        $u = Utilisateur::where('pseudo', '=', $pseudo)->first();

        if (!$u) {
            $app->response = new Response('{}', 406, ['Content-Type' => 'application/json']);
            return;
        }

        if (!$checked)
            $app->response = new Response('{"pass":"' . $u['pass'] . '"}', 200, ['Content-Type' => 'application/json']);
        else {
            $_SESSION['pseudo'] = $u['pseudo'];
        }
    }

    public function déconnecter() {
        unset($_SESSION['pseudo']);
    }

    public function afficherProfil() {
        if (!isset($_SESSION['pseudo'])) {
            $app = Slim::getInstance();
            $app->response = new Response('', 403, []);
            return;
        }

        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->first();
        (new v\ProfilPage($u, $u->listes()->all()))->afficher();
    }
}

?>