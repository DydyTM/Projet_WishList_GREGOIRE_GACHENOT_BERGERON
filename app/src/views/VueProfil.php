<?php

namespace wishlist\views;

class VueProfil {
    public static function render() {
        $anyConnected = isset($_COOKIE['user_connected']);
        if ($anyConnected) {
            $pseudo = $_COOKIE['pseudo'];
            return "Bienvenue <a class=\"invisible-link\" href='/profil'>$pseudo</a> !          <a class\"invisible-link\" href='javascript:logout()'>Se déconnecter</a>";
        } else {
            return "<a class=\"invisible-link\" href='/login'>Se connecter</a> ou <a class=\"invisible-link\" href='/signup'>s'inscrire</a>";
        }
        
    }
}

?>