<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;
use wishlist\templates\Template as Template;

class ProfilTemplate extends Template {
    public static function generateLogin() {
        return "
            <form action=login method=POST>
                <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
                <div class=\"pageLogin\">Page Login !</div>
                <div class=\"form desc\">
                    Pseudo :
                </div>
                <div class=\"form input\">
                    <input type=text name=pseudo placeholder=\"Pseudo\"/>
                </div>
                <div class=\"form desc\">
                    Mot de passe :
                </div>
                <div class=\"form input\">
                    <input type=text name=pass placeholder=\"mot de passe\"/>
                </div>
                <div class=\"form\">
                    <input type=submit value=OK>
                </div>
            </form>
        ";
    }

    public static function generateSignup() {
        return "
        
        ";
    }
}

?>