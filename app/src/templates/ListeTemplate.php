<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;

class ListeTemplate extends Template {
    public static function generateNew() {
        return "
            <form action=liste method=POST>
                <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
                <div class=\"nouvelleListe\">Nouvelle liste à créer !</div>
                <div class=\"form\" class \"desc\">
                Titre :
                </div>
                <div class=\"form\" class \"input\">
                <input type=text name=titre placeholder=\"Ma wishlist\"/>
                </div>
                <div class=\"form\" class \"desc\">
                Description :
                </div>
                <div class=\"form\" class \"input\">
                <textarea type=text name=description placeholder=\"Une super wishlist\"></textarea>
                </div>
                <div class=\"form\" class \"desc\">
                Date d'expiration :
                </div>
                <div class=\"form\" class \"input\">
                <input type=date name=expiration />
                </div>
                <input type=submit value=OK>
            </form>
        ";
    }
}

?>