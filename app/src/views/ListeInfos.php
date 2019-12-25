<?php

namespace wishlist\views;

use wishlist\Chemins;

class ListeInfos {
    private $token;
    private $liste;

    public function __construct($tk, $l) {
        $this->token = $tk;
        $this->liste = $l;
    }

    public function afficher() {
        $titre = $this->liste['titre'];
        $descr = $this->liste['description'];
        $expir = $this->liste['expiration'];
        $JS    = Chemins::$JS;

        include __DIR__ . '/Header.php';
        echo <<< end
            <form method=POST id='modlist-form'>
                <div class="nouvelleListe">Liste à modifier !</div>
                <div class="form desc">
                    Titre :
                </div>
                <div class="form input">
                    <input type=text name=titre placeholder="Ma wishlist" value="$titre"/>
                </div>
                <div class="form desc">
                    Description :
                </div>
                <div class="form input">
                    <textarea type=text name=description placeholder="Une super wishlist">$description</textarea>
                </div>
                <div class="form desc">
                    Date d'expiration :
                </div>
                <div class="form input">
                    <input type=date name=expiration value="$expir" />
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