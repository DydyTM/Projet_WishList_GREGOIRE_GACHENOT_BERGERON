<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemShort {
    private $item;
    private $token;

    public function __construct($item, $token) {
        $this->item  = $item;
        $this->token = $token;
    }

    public function afficher() {
        $id    = $this->item['id'];
        $img   = $this->item['img'];
        $nom   = $this->item['nom'];
        $descr = $this->item['descr'];
        $tarif = $this->item['tarif'];
        $url   = $this->item['url'];
        $token = $this->token;
        $path  = Slim::getInstance()->urlFor('affichageItem', ['token' => $token, 'id' => $id]);

        $IMG   = Chemins::$IMG;

        echo <<< end
            <div class="row">
                <a class="invisible-link" href="$path">
                    <img class="imageObjet" src="$IMG/$img" height='70' width='70'>
                    <div>
                        <div><u>Item #$id : $nom</u><br>$descr<br>Tarif : $tarif €</div>
                    </div>
                </a>
            </div>
        end;
    }
}

?>