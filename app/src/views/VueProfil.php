<?php

namespace wishlist\views;

class VueProfil {
    public static function render() {
        $anyConnected = isset($_COOKIE['user_connected']);
        if ($anyConnected) {
            return VueProfil::renderConnected();
        } else {
            return VueProfil::renderDisconnected();
        }
    }

    private static function renderConnected() {
        $pseudo = $_COOKIE['pseudo'];

        return "Bienvenue <a href='/profil'>$pseudo</a> !          <a href='javascript:logout()'>Se déconnecter</a>";
    }

    private static function renderDisconnected() {
        return "<a class=\"invisible-link\" href='/login'>Se connecter</a> ou <a class=\"invisible-link\" href='/signup'>s'inscrire</a>";
    }
}

?>