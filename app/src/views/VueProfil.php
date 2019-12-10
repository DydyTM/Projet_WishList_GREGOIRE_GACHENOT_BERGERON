<?php

namespace wishlist\views;

class VueProfil {
    public static function render() {
        $pseudo = $_COOKIE['pseudo'];

        return "Bienvenue <a href='/profile/$pseudo'>$pseudo</a> !          <a href='/logout'>Se déconnecter</a>";
    }
}

?>