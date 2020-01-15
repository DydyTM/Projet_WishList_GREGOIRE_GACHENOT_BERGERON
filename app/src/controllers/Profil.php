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
        $l->pseudo = filter_var($pseudo, FILTER_SANITIZE_SPECIAL_CHARS);
        $l->pass = $mdp;
        $l->save();

        $_SESSION['pseudo'] = flter_var($pseudo, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function connexion($pseudo, $checked) {
        $app = Slim::getInstance();
        $u = Utilisateur::where('pseudo', '=', filter_var($pseudo, FILTER_SANITIZE_SPECIAL_CHARS))->first();

        if (!$u) {
            return $app->response = new Response('', 403, []);
        }

        if (!$checked) {
            return $app->response = new Response('{"pass":"' . $u['pass'] . '"}', 200, ['Content-Type' => 'application/json']);
        }

        $_SESSION['pseudo'] = $u['pseudo'];
    }

    public function déconnecter() {
        unset($_SESSION['pseudo']);
    }

    public function afficherProfil() {
        $app = Slim::getInstance();

        if (!isset($_SESSION['pseudo'])) {
            return $app->response = new Response('', 403, []);
        }

        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->first();

        if (!$u) {
            return $app->response = new Response('', 403, []);
        }
        (new v\ProfilPage($u, $u->listes()->all()))->afficher();
    }
}

?>