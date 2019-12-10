<?php

namespace wishlist\views;

class VueProfil {
    public static function render() {
        $pseudo = $_COOKIE['pseudo'];

        return "Bienvenue <a href='/profil'>$pseudo</a> !          <a href='javascript:logout()'>Se déconnecter</a>";
    }
}

?>