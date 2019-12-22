<?php

namespace wishlist\views;

class ItemNouveau {
    public function afficher() {
        echo <<< end
            <form action=item method=POST>
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
                    <input type="number" name=prixItem min="0.00" step="0.01" />
                </div>
                <div class="form">
                    <input type=submit value="Ajouter">
                </div>
            </form>
        end;
    }
}

?>