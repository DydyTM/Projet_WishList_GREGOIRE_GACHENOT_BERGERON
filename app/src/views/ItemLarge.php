<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemLarge {
    private $item;
    private $token;
    private $participant;

    public function __construct($item, $token, $proprio) {
        $this->item         = $item;
        $this->token        = $token;
        $this->propriétaire = $proprio;
    }

    public function afficher() {
        $id          = $this->item['id'];
        $img         = $this->item['img'];
        $nom         = $this->item['nom'];
        $descr       = $this->item['descr'];
        $tarif       = $this->item['tarif'];
        $participant = $this->item['participant'];
        $pseud       = $this->propriétaire['pseudo'];
        $url         = $this->item['url'];
        $token       = $this->token;
        $path        = Slim::getInstance()->urlFor('affichageItem', ['token' => $token, 'id' => $id]);

        $IMG         = Chemins::$IMG;
        $JS          = Chemins::$JS;

        include __DIR__ . '/Header.php';
        echo <<< end
            <div>
                <div class="row">
                    <div>
                        <img class="imageObjet" src="$IMG/$img" height='70' width='70'>
                        <div>
                            <div><u>Item #$id : $nom</u><br>$descr<br>Tarif : $tarif €</div>
            end;
            if($url) {
                echo <<< end
                            <br> URL : <a href = "$url" target = "_blank" > Lien vers Amazon </a >
                end;
            }
            echo <<< end
                        </div >
                    </div>
                </div>
            end;
                    
        if($pseud !== $_SESSION['pseudo']) {
            if(!isset($participant)) {
                $particip = $_SESSION['particip'];
                echo <<< end
                <form method=POST id="resitem-form" action="/liste/$token/items/$id">
                    <br><br><br>    
                    <div class="form partipItem">Souhaitez-vous participer ?</div>
                        <div class="form desc">
                            Votre nom :
                        </div>
                        <div class="form input">
                            <input type=text name=titre placeholder="Nom du participant" value="$particip"/>
                        </div>
                        <div class="form">
                            <input type=submit value="Participer">
                        </div>
                    </div>
                </form>
                end;
            } else {
                echo <<< end
                <div>Réservé par $participant</div>
                end;
            }
        }
        if(!isset($participant) && $pseud === $_SESSION['pseudo']) {
            echo <<< end
            <div class="supprItem">
                <form method=POST id="delitem-form" action="/liste/$token/items/$id">
                    <div class="form">
                        <input type=submit value="Supprimer l'item">
                    </div>
                </form>
            </div>
            end;
        }
        echo <<< end
            </div>
            <script src="$JS/item.js"></script>
        end;
        include __DIR__ . '/Footer.php';
    }
}


?>