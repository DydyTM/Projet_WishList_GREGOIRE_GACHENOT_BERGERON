<?php

namespace wishlist\controllers;

use wishlist\models as mdls;
use wishlist\views\ItemLarge;

class Item {
    // 2 : Affiche un item d'une liste
    public function afficherItem($listeToken, $id) {
        $i = mdls\Liste::where('token_visu', '=', $listeToken)->first()->items()->where('id', '=', $id)->first();
        if ($i)
            (new ItemLarge($i, $listeToken))->afficher();
        else {
            // TODO: throw 404 error
        }
    }
}

?>