<?php

namespace wishlist\templates;

use wishlist\templates\Template as T;

class IndexTemplate extends T {
    public static function generate() {
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
            <span>My wishlist</span>
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