<?php

namespace wishlist\controllers;

use wishlist\views\VueConnexion as VueConnexion;
use wishlist\templates\ProfilTemplate as ProfilTemplate;
use wishlist\models\Utilisateur as Utilisateur;
use wishlist\models\Liste as Liste;

class ControllerUser {

    public function connexionUser() {
        VueConnexion::render_with(ProfilTemplate::generateLogin());
    }

    public function inscriptionUser() {
        VueConnexion::render_with(ProfilTemplate::generateSignup());
    }

    public function pageProfil($pseudo) {
        $u = Utilisateur::select('user_id')->where('pseudo', '=', $pseudo)->first();
        $lists = Liste::where('user_id', '=', $u["user_id"])->get()->all();
        VueConnexion::render_with(ProfilTemplate::profile($lists));
    }


}

?>