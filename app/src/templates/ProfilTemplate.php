<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;
use wishlist\templates\Template as Template;

class ProfilTemplate extends Template {
    public static function generateLogin() {
        return "
            <form action=/login method=POST>
                <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
                <div class=\"pageLogin\">Page de connexion !</div>
                <div class=\"form desc\">
                    Pseudo :
                </div>
                <div class=\"form input\">
                    <input type=text name=pseudo placeholder=\"Saisir un pseudo\"/>
                </div>
                <div class=\"form desc\">
                    Mot de passe :
                </div>
                <div class=\"form input\">
                    <input type=password name=pass placeholder=\"Saisir un mot de passe\"/>
                </div>
                <div class=\"form\">
                    <input type=submit value=OK>
                </div>
            </form>
        ";
    }

    public static function generateSignup() {
        return "
            <form action=/signup method=POST>
                <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
                <div class=\"pageLogin\">Page d'inscription !</div>
                <div class=\"form desc\">
                    Saisir un pseudo :
                </div>
                <div class=\"form input\">
                    <input type=text name=pseudo placeholder=\"Pseudo\"/>
                </div>
                <div class=\"form desc\">
                    Saisir un mot de passe :
                </div>
                <div class=\"form input\">
                    <input type=password name=pass placeholder=\"Mot de passe\"/>
                </div>
                <div class=\"form\">
                    <input type=submit value=OK>
                </div>
            </form>
        
        ";
    }

    public static function profile() {
        $pseudo = $_COOKIE['pseudo'];
        return "Page de profil de " . $pseudo . " <a href='/profil'>$pseudo</a> !  <a href='/nouveau/liste'>Créer une nouvelle liste</a>";
    }
}

?>