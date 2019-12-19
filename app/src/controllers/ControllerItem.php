<?php


namespace wishlist\controllers;

use wishlist\views\VueItem as VueItem;
use wishlist\models\Item as Item;
use wishlist\models\Liste as Liste;

class ControllerItem
{

    public function afficheItemListe($token, $id)
    {
        $no = Liste::select('no')->where('token_visu', '=', $token)->first();
        $item = Item::where('id', '=', $id)->where('liste_id', '=', $no)->first();
        if (!$item) {
            return "<p>No item found with id '$id'</p>";
        }

        $view = new VueItem([$item]);
        return $view->to_string(3);
    }

    public function ajouterItemListe($token)
    {
        VI::render_with(IT::generateNew());
    }
}