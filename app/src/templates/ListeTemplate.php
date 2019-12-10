<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;

class ListeTemplate extends Template {
    public static function generateNew() {
        return "
            <form action=liste method=POST>
                <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
                <div class=\"nouvelleListe\">Nouvelle liste à créer !</div>
                <div class=\"form desc\">
                    Titre :
                </div>
                <div class=\"form input\">
                    <input type=text name=titre placeholder=\"Ma wishlist\"/>
                </div>
                <div class=\"form desc\">
                    Description :
                </div>
                <div class=\"form input\">
                    <textarea type=text name=description placeholder=\"Une super wishlist\"></textarea>
                </div>
                <div class=\"form desc\">
                    Date d'expiration :
                </div>
                <div class=\"form input\">
                    <input type=date name=expiration />
                </div>
                <div class=\"form\">
                    <input type=submit value=OK>
                </div>
            </form>
        ";
    }
}

?>