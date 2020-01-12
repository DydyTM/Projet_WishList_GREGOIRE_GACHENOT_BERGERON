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
        $titre       = $this->liste['titre'];
        $description = $this->liste['description'];
        $expir       = $this->liste['expiration'];
        $token       = $this->token;
        $checked     = $this->liste['publique'];
        $JS          = Chemins::$JS;

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
                <div class="form desc">
                    Liste publique : 
                </div>
                <div class="form check">
                    <input type=checkbox name=publique
        end;
        if ($checked === 1)
            echo " checked";
        echo <<< end
                    />
                </div>
                <div class="form">
                    <input type=submit value="OK">  
                </div>
            </form>

            <button onclick="javascript:ajouterItem('$token')">Ajouter un item</button>
            <form method=POST id="delliste-form" action="/liste/$token">
                <div class="form">
                    <input type=submit value="Supprimer la liste">
                </div>
            </form>

            <script src="$JS/liste.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>