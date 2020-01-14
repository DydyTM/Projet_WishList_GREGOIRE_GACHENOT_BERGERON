<?php

namespace wishlist\views;

use wishlist\Chemins;
use Slim\Slim;

class ItemLarge {
    private $item;
    private $token;
    private $participant;
    private $expiré;

    public function __construct($item, $token, $proprio, $expir) {
        $this->item         = $item;
        $this->token        = $token;
        $this->propriétaire = $proprio;
        $this->expiré       = $expir;
    }

    public function afficher() {
        $id          = $this->item['id'];
        $img         = $this->item['img'];
        $nom         = $this->item['nom'];
        $descr       = $this->item['descr'];
        $tarif       = $this->item['tarif'];
        $participant = $this->item['participant'];
        $commentaire = $this->item['commentaire'];
        $pseud       = $this->propriétaire['pseudo'];
        $url         = $this->item['url'];
        $token       = $this->token;
        $expir       = $this->expiré;
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
                            <br> URL : <a href = "$url" target = "_blank" > Lien</a >
                end;
            }
            echo <<< end
                        </div >
                    </div>
            end;
                    
        if($pseud !== $_SESSION['pseudo'] || $expir) {
            if(!isset($participant) && !$expir) {
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
                        <div class="form desc">
                            Votre commentaire :
                        </div>
                        <div class="form input">
                            <textarea type=text name=description placeholder="Un super commentaire">$commentaire</textarea>
                        </div>
                        <div class="form">
                            <input type=submit value="Participer">
                        </div>
                    </div>
                </form>
                end;
            } else {
                echo <<< end
                <div>Réservé par $participant :</div>
                <div>$commentaire</div>
                </div>
                end;
            }
        }
        if(!isset($participant) && $pseud === $_SESSION['pseudo'] && !$expir) {
            echo <<< end
                <div class="modifiItem">
                    <form method=POST id="modifitem-form" action="/liste/$token/items/$id/infos">
                        <div class="modifDescItem">Modifcation de l'item !</div>
                        <div class="form desc">
                            Nom :
                        </div>
                        <div class="form input">
                            <input type=text name=titre placeholder="Nom item" value="$nom"/>
                        </div>
                        <div class="form desc">
                            Description :
                        </div>
                        <div class="form input">
                            <textarea type=text name=description placeholder="Un super item">$descr</textarea>
                        </div>
                        <div class="form desc">
                            Prix :
                        </div>
                        <div class="form input">
                            <input type="number" name=prixItem min="0.00" step="0.01" value="$tarif"/>
                        </div>
                        <div class="form input">
                            <input type=text name=urlProduit placeholder="URL du produit (Amazon)" value="$url"/>
                        </div>
                        <div class="form">
                            <input type=submit value="Modifier">
                        </div>
                    </form>
                </div>
                <div class="supprItem">
                    <form method=POST id="delitem-form" action="/liste/$token/items/$id/del">
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