<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;
use wishlist\views\VueProfil as VueProfil;

class IndexTemplate extends T {
    public static function generate() {
        $profil = VueProfil::render();
        
        return "
<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">

        <title>My Wishlist</title>

        <!-- Custom styles for this template-->
        <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
    </head>
    <body>
        <header class=\"page-top\">
            <div class=\"title\">
                <a class=\"invisible-link\" href=/>My wishlist</a>
            </div>
            <span class=profile>
                $profil
            </span>
        </header>
        <div id=content>
            %s
        </div>
        <footer class=\"page-bottom\">
            <hr>
            <div>Copyright &copy; My Wishlist 2019 <br>
                 BERGERON Ghilain, GREGOIRE Dylan, GACHENOT Antoine</div>
        </footer>
    </body>

    <script src=\"" . T::$JS_BASE_DIR . "/logout.js\"></script>
    <script src=\"" . T::$JS_BASE_DIR . "/ajax.js\"></script>
</html>
        ";
    }
}

?>