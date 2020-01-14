<?php

namespace wishlist\views;

use wishlist\Chemins;
use wishlist\views\ItemShortModif as ISM;

class ListeInfos {
    private $token;
    private $liste;
    private $items;
    private $pseudo;

    public function __construct($tk, $l, $i, $p) {
        $this->token = $tk;
        $this->liste = $l;
        $this->items  = $i;
        $this->pseudo = $p;
    }

    public function afficher() {
        $titre       = $this->liste['titre'];
        $description = $this->liste['description'];
        $expir       = $this->liste['expiration'];
        $token       = $this->token;
        $checked     = $this->liste['publique'];
        $items       = $this->items;
        $pseudo      = $this->pseudo;
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

            <button style="display: block; margin: auto; margin-bottom: 10px;" onclick="javascript:ajouterItem('$token')">Ajouter un item</button>
            <form method=POST id="delliste-form" action="/liste/$token">
                <div class="form">
                    <input type=submit value="Supprimer la liste">
                </div>
            </form>
            <br><br>
        end;
        if($pseudo !== $_SESSION['pseudo']) {
            echo <<< end
            <h3><u>Item à modifier : </u></h3><br>
            end;
            foreach ($items as $item) {
                (new ISM($item, $token, $pseudo))->afficher();
            }
        }
        echo <<< end
            <script src="$JS/liste.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}

?>