<?php

namespace wishlist\controllers;

use wishlist\views\VueConnexion as VueConnexion;
use wishlist\templates\ProfilTemplate as ProfilTemplate;

class ControllerUser {

    public function connexionUser() {
        VueConnexion::render_with(ProfilTemplate::generateLogin());
    }


}

?>