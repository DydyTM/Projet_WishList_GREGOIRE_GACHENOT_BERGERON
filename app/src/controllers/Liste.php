<?php

namespace wishlist\controllers;

use wishlist\views as v;
use wishlist\models\Liste as MListe;
use wishlist\models\Utilisateur;
use Slim\Slim;
use Slim\Http\Response;

class Liste {
    // 1 : Affiche une liste de souhaits
    public function afficherItems($tk) {
        $l    = MListe::where('token_visu', '=', $tk)->first();
        $prop = Utilisateur::where('user_id', '=', $l['user_id'])->select('user_id')->first() || ['pseudo' => 'un inconnu'];
        (new v\ListeComplete($l, $l->items()->all(), $prop))->afficher();
    }

    // 6 : Créer une liste
    public function créerListe($titre, $description, $expire) {
        $app = Slim::getInstance();
        if (!isset($_SESSION['pseudo'])) {
            $app->response = new Response('', 403, []);
            return;
        }

        $u = Utilisateur::where('pseudo', '=', $_SESSION['pseudo'])->select('user_id')->first();

        $l = new MListe();
        $l->titre = $titre;
        $l->description = $description;
        $l->user_id = $u['user_id'];
        $l->expiration = $expire;
        do {
            $l->token_visu = self::generateToken(25);
            $liste = MListe::where('token_visu', '=', $l->token_visu)->first();
        } while ($liste);
        do {
            $l->token_modif = self::generateToken(25);
            $liste = MListe::where('token_modif', '=', $l->token_modif)->first();
        } while ($liste);
        $l->save();

        $app->redirect($app->urlFor('affichageProfil'));
    }

    private function generateToken($length = 10) {
        $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
    }

    public function nouvelleListe() {
        (new v\ListeNouveau())->afficher();
    }
}

?>