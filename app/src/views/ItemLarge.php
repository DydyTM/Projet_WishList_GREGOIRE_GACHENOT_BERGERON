<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemLarge {
    private $item;
    private $token;
    private $participant;

    public function __construct($item, $token) {
        $this->item  = $item;
        $this->token = $token;
    }

    public function afficher() {
        $id          = $this->item['id'];
        $img         = $this->item['img'];
        $nom         = $this->item['nom'];
        $descr       = $this->item['descr'];
        $tarif       = $this->item['tarif'];
        $participant = $this->item['participant'];
        $url         = $this->item['url'];
        $token       = $this->token;
        $path        = Slim::getInstance()->urlFor('affichageItem', ['token' => $token, 'id' => $id]);

        $IMG         = Chemins::$IMG;
        $JS          = Chemins::$JS;

        include __DIR__ . '/Header.php';
        echo <<< end
                <div class="row">
                    <div>
                        <img class="imageObjet" src="$IMG/$img" height='70' width='70'>
                        <div>
                            <div><u>Item #$id : $nom</u><br>$descr<br>Tarif : $tarif €<br>URL : <a href="$url" target="_blank">Lien vers Amazon</a></div>
                        </div>
                    </div>
        end;
        
        if(!isset($participant)) {
            echo <<< end
                    <form method=POST id="resitem-form" action="/liste/$token/items/$id">
                        <br><br><br>
                        <div class="form partipItem">Souhaitez-vous participer ?</div>
                            <div class="form desc">
                                Votre nom :
                            </div>
                            <div class="form input">
                                <input type=text name=titre placeholder="Nom du participant" value="$participant"/>
                            </div>
                            <div class="form">
                                <input type=submit value="Participer">
                            </div>
                        </div>
                    </form>
                </div>

                <script src="$JS/item.js"></script>
            end;
        } else {
            echo <<< end
                    <div>Réservé par $participant</div>
                    <div>Lien du produit : $url</div>
                </div>
            end;
        }
        include __DIR__ . '/Footer.php';
    }
}

?>