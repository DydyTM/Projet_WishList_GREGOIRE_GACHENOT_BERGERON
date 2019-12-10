<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;

class ListeTemplate extends Template {
    public static function generateNew() {
        return "
            <form action=liste method=POST>
                <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
                <div class=\"nouvelleListe\">Nouvelle liste à créer ! <br><br></div>
                <p>
                Titre :
                <input type=text name=titre />
                Description :
                <input type=text name=description />
                Date d'expiration :
                <input type=date name=expiration /> </p>
                <input type=submit value=OK>
            </form>
        ";
    }
}

?>