<?php


namespace wishlist\controllers;

use wishlist\views\VueItem as VueItem;
use wishlist\models\Item as Item;

class ControllerItem
{

    public function afficheItemListe($îd_item)
    {
        $item = Item::where('id_item', '=', $id_item)->first();
        if (!$item) {
            echo "<p>No item found with id '$id_item'</p>";
            return;
        }

        $view = new VueItem([$item]);
        $view->render(3);
    }
}


