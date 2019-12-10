<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;
use wishlist\views\VueProfil as VueProfil;

class IndexTemplate extends T {
    public static function generate() {
        $anyConnected = isset($_COOKIE['user_connected']);
        if ($anyConnected) {
            $profil = VueProfil::render();
        } else {
            $profil = "<a href='/login'>Se connecter</a> ou <a href='/signup'>s'inscrire</a>";
        }


        return "
<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">

        <title>My wishlist</title>

        <!-- Custom styles for this template-->
        <link href=\"" . T::$CSS_BASE_DIR . "/my-wishlist.css\" rel=\"stylesheet\">
    </head>
    <body>
        <header class=\"page-top\">
            <a href=/>My wishlist</a>

            <span class=profile>
                $profil
            </span>
        </header>
        <div id=content>
            %s
        </div>
        <footer class=\"page-bottom\">
            <hr>
            <div>Copyright &copy; my wishlist 2019</div>
        </footer>
    </body>
</html>
        ";
    }
}

?>