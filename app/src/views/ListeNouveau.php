<?php

namespace wishlist\views;

use Slim\Slim;
use wishlist\Chemins;

class ListeNouveau {
    public function afficher() {
        $liste = Slim::getInstance()->urlFor('créerListe');
        $JS    = Chemins::$JS;

        include __DIR__ . '/Header.php';
        echo <<< end
            <form action=$liste method=POST id='newlist-form'>
                <div class="nouvelleListe">Nouvelle liste à créer !</div>
                <div class="form desc">
                    Titre :
                </div>
                <div class="form input">
                    <input type=text name=titre placeholder="Ma wishlist"/>
                </div>
                <div class="form desc">
                    Description :
                </div>
                <div class="form input">
                    <textarea type=text name=description placeholder="Une super wishlist"></textarea>
                </div>
                <div class="form desc">
                    Date d'expiration :
                </div>
                <div class="form input">
                    <input type=date name=expiration />
                </div>
                <div class="form">
                    <input type=submit value="OK">
                </div>
            </form>

            <script src="$JS/liste.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>