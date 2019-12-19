<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;
use wishlist\templates\Template as Template;
use wishlist\views\VueListe as VueListe;

class ProfilTemplate extends Template {
    public static function generateLogin() {
        return "
            <form action=/login method=POST id=\"login-form\">
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

            <script src=\"" . T::$JS_BASE_DIR . "/profil.js\"></script>
        ";
    }

    public static function generateSignup() {
        return "
            <form method=POST id=\"signup-form\">
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
        
            <script src=\"" . T::$JS_BASE_DIR . "/profil.js\"></script>
        ";
    }

    public static function profile($lists) {
        $pseudo = $_COOKIE['pseudo'];
        $vl = new VueListe($lists);
        return "Page de profil de <a href='/profil'>$pseudo</a> !<br>
            <form action='/nouveau/liste' method='GET'><input type=submit value='Créer une nouvelle liste'/></form>"
            . $vl->to_string(1);
    }
}

?>