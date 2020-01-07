<?php

namespace wishlist\views;
use wishlist\Chemins;

class ItemNouveau {
    private $token;

    public function __construct($tk) {
        $this->token = $tk;
    }

    public function afficher() {
        $token = $this->token;
        $JS    = Chemins::$JS;

        include __DIR__ . '/Header.php';
        echo <<< end
            <form method=POST id="newitem-form" token="$token">
                <div class="nouvelItem">Nouvel item à créer !</div>
                <div class="form desc">
                    Nom :
                </div>
                <div class="form input">
                    <input type=text name=titre placeholder="Nom item"/>
                </div>
                <div class="form desc">
                    Description :
                </div>
                <div class="form input">
                    <textarea type=text name=description placeholder="Un super item"></textarea>
                </div>
                <div class="form desc">
                    Prix :
                </div>
                <div class="form input">
                    <input type="number" name=prixItem min="0.00" step="0.01"/>
                </div>
                <div class="form input">
                    <input type=text name=urlProduit placeholder="URL du produit sur Amazon"/>
                </div>
                <div class="form">
                    <input type=submit value="Ajouter">
                </div>
            </form>

            <script src="$JS/liste.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>