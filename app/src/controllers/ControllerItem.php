<?php


namespace wishlist\controllers;

use wishlist\views\VueItem as VueItem;
use wishlist\models\Item as Item;

class ControllerItem
{

    public function afficheItemListe($no, $id)
    {
        $item = Item::where('id', '=', $id)->where('liste_id', '=', $no)->first();
        if (!$item) {
            return "<p>No item found with id '$id'</p>";
        }

        $view = new VueItem([$item]);
        return $view->to_string(3);
    }
}


