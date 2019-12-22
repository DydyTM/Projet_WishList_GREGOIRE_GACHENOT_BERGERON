<?php

namespace wishlist\views;

use Slim\Slim;

class ListeLarge {
    private $liste;

    public function __construct($liste) {
        $this->liste = $liste;
    }

    public function afficher() {
        $liste  = Slim::getInstance()->urlFor('affichageListe', ['token' => $this->liste['token_visu']]);
        $no     = $this->liste['no'];
        $titre  = $this->liste['titre'];
        $descr  = $this->liste['description'];
        $expire = $this->liste['expiration'];

        echo <<< end
            <div class="row list">
                <a class="invisible-link" href="$liste">
                    <div class="col mr-2">
                        <div>Liste #$no: $titre</div>
                        <div>$descr</div>
                        <div>Expire: $expire</div>
                    </div>
                </a>
            </div>
        end;
    }
}

?>